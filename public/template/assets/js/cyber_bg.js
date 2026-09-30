/**
 * AABW Cyber-Blueprint Dynamic Animated Background & Interactive Audio-Visual Engine
 * Inspired by https://al.is-a.dev
 * Canvas Graph-Paper Grid, Moving Vector Curves, Interactive Constellations, Click Radar Ripples,
 * Glitch Burst Engine, & Web Audio Synthesizer
 */

(function () {
  'use strict';

  // --- AUDIO SYNTHESIZER (Native Web Audio API, Zero Latency, Zero Dependencies) ---
  let audioCtx = null;
  function getAudioContext() {
    if (!audioCtx) {
      const AudioContext = window.AudioContext || window.webkitAudioContext;
      if (AudioContext) {
        audioCtx = new AudioContext();
      }
    }
    if (audioCtx && audioCtx.state === 'suspended') {
      audioCtx.resume();
    }
    return audioCtx;
  }

  function playCyberBlip(freq = 1100, type = 'sine', duration = 0.05, vol = 0.035) {
    try {
      const ctx = getAudioContext();
      if (!ctx) return;
      const osc = ctx.createOscillator();
      const gain = ctx.createGain();
      osc.type = type;
      osc.frequency.setValueAtTime(freq, ctx.currentTime);
      osc.frequency.exponentialRampToValueAtTime(freq * 1.5, ctx.currentTime + duration);
      gain.gain.setValueAtTime(vol, ctx.currentTime);
      gain.gain.exponentialRampToValueAtTime(0.0001, ctx.currentTime + duration);
      osc.connect(gain);
      gain.connect(ctx.destination);
      osc.start();
      osc.stop(ctx.currentTime + duration);
    } catch (e) {
      // Audio autoplay policy fallback
    }
  }

  // --- FULLSCREEN CANVAS BACKGROUND ---
  const canvas = document.createElement('canvas');
  canvas.id = 'cyber-canvas-bg';
  canvas.style.position = 'fixed';
  canvas.style.top = '0';
  canvas.style.left = '0';
  canvas.style.width = '100vw';
  canvas.style.height = '100vh';
  canvas.style.pointerEvents = 'none';
  canvas.style.zIndex = '0';
  canvas.style.opacity = '0.95';

  document.body.prepend(canvas);

  const ctx = canvas.getContext('2d');
  let width, height;
  let mouseX = -1000;
  let mouseY = -1000;
  let targetMouseX = -1000;
  let targetMouseY = -1000;

  function resize() {
    width = canvas.width = window.innerWidth;
    height = canvas.height = window.innerHeight;
  }
  window.addEventListener('resize', resize);
  resize();

  window.addEventListener('mousemove', (e) => {
    targetMouseX = e.clientX;
    targetMouseY = e.clientY;
  });

  // --- RADAR RIPPLES ON CLICK ---
  const ripples = [];
  window.addEventListener('click', (e) => {
    ripples.push({
      x: e.clientX,
      y: e.clientY,
      radius: 4,
      maxRadius: 160,
      alpha: 0.65,
      speed: 4.5
    });
    playCyberBlip(1250, 'triangle', 0.06, 0.04);
  });

  // --- FLOATING BLUEPRINT NODES & CROSSHAIRS ---
  const nodeCount = Math.floor(Math.min(window.innerWidth / 28, 55));
  const nodes = [];

  for (let i = 0; i < nodeCount; i++) {
    nodes.push({
      x: Math.random() * window.innerWidth,
      y: Math.random() * window.innerHeight,
      vx: (Math.random() - 0.5) * 0.5,
      vy: (Math.random() - 0.5) * 0.5,
      size: Math.random() > 0.65 ? 4 : 2,
      isCross: Math.random() > 0.45,
      alpha: 0.25 + Math.random() * 0.5
    });
  }

  // --- ANIMATED TECHNICAL VECTOR BEZIER CURVES ---
  const waveCurves = [
    { yOffset: 0.22, speed: 0.0009, amp: 48, freq: 0.002, color: 'rgba(56, 189, 248, 0.09)' },
    { yOffset: 0.58, speed: 0.0013, amp: 68, freq: 0.0016, color: 'rgba(2, 132, 199, 0.07)' },
    { yOffset: 0.82, speed: 0.0007, amp: 40, freq: 0.0024, color: 'rgba(0, 229, 255, 0.08)' }
  ];

  let time = 0;

  function draw() {
    time += 1;
    ctx.clearRect(0, 0, width, height);

    // Smooth mouse interpolation
    mouseX += (targetMouseX - mouseX) * 0.09;
    mouseY += (targetMouseY - mouseY) * 0.09;

    // 1. Moving Blueprint Wave Curves (Dotted CAD Curves)
    waveCurves.forEach(wave => {
      ctx.beginPath();
      ctx.strokeStyle = wave.color;
      ctx.lineWidth = 1.5;
      ctx.setLineDash([8, 12]);

      const baseFreq = wave.freq;
      for (let x = 0; x <= width; x += 20) {
        const y = height * wave.yOffset + Math.sin(x * baseFreq + time * wave.speed) * wave.amp + Math.cos(x * 0.001 + time * 0.001) * 22;
        if (x === 0) ctx.moveTo(x, y);
        else ctx.lineTo(x, y);
      }
      ctx.stroke();
      ctx.setLineDash([]);
    });

    // 2. Click Radar Ripples
    for (let r = ripples.length - 1; r >= 0; r--) {
      const rip = ripples[r];
      rip.radius += rip.speed;
      rip.alpha -= 0.015;

      if (rip.alpha <= 0 || rip.radius >= rip.maxRadius) {
        ripples.splice(r, 1);
        continue;
      }

      ctx.save();
      ctx.strokeStyle = `rgba(0, 240, 255, ${rip.alpha})`;
      ctx.lineWidth = 1.5;
      ctx.setLineDash([4, 6]);
      ctx.beginPath();
      ctx.arc(rip.x, rip.y, rip.radius, 0, Math.PI * 2);
      ctx.stroke();

      // Outer secondary ring
      ctx.strokeStyle = `rgba(56, 189, 248, ${rip.alpha * 0.5})`;
      ctx.lineWidth = 1;
      ctx.beginPath();
      ctx.arc(rip.x, rip.y, rip.radius * 0.7, 0, Math.PI * 2);
      ctx.stroke();
      ctx.restore();
    }

    // 3. Interactive Moving Nodes & Coordinate Crosshairs (+)
    for (let i = 0; i < nodes.length; i++) {
      const n = nodes[i];
      n.x += n.vx;
      n.y += n.vy;

      // Wrap edges
      if (n.x < 0) n.x = width;
      if (n.x > width) n.x = 0;
      if (n.y < 0) n.y = height;
      if (n.y > height) n.y = 0;

      // Distance to cursor
      const dx = mouseX - n.x;
      const dy = mouseY - n.y;
      const dist = Math.sqrt(dx * dx + dy * dy);

      // Mouse magnetic interaction
      if (dist < 190) {
        const force = (190 - dist) / 190;
        n.x -= (dx / dist) * force * 1.6;
        n.y -= (dy / dist) * force * 1.6;

        // Draw interactive cyan constellation line to cursor
        ctx.strokeStyle = `rgba(0, 240, 255, ${0.4 * force})`;
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(n.x, n.y);
        ctx.lineTo(mouseX, mouseY);
        ctx.stroke();
      }

      // Draw Crosshair (+) or Node
      if (n.isCross) {
        ctx.strokeStyle = `rgba(56, 189, 248, ${n.alpha})`;
        ctx.lineWidth = 1.3;
        const s = n.size + 3;
        ctx.beginPath();
        ctx.moveTo(n.x - s, n.y);
        ctx.lineTo(n.x + s, n.y);
        ctx.moveTo(n.x, n.y - s);
        ctx.lineTo(n.x, n.y + s);
        ctx.stroke();
      } else {
        ctx.fillStyle = `rgba(0, 240, 255, ${n.alpha})`;
        ctx.beginPath();
        ctx.arc(n.x, n.y, n.size, 0, Math.PI * 2);
        ctx.fill();
      }

      // Connect neighbor nodes with subtle tech blueprint lines
      for (let j = i + 1; j < nodes.length; j++) {
        const n2 = nodes[j];
        const ndx = n.x - n2.x;
        const ndy = n.y - n2.y;
        const nDist = Math.sqrt(ndx * ndx + ndy * ndy);

        if (nDist < 130) {
          const lineAlpha = (1 - nDist / 130) * 0.18;
          ctx.strokeStyle = `rgba(56, 189, 248, ${lineAlpha})`;
          ctx.lineWidth = 0.8;
          ctx.beginPath();
          ctx.moveTo(n.x, n.y);
          ctx.lineTo(n2.x, n2.y);
          ctx.stroke();
        }
      }
    }

    // 4. Subtle Animated Scanline Tracker
    const scanY = (time * 1.3) % height;
    ctx.strokeStyle = 'rgba(56, 189, 248, 0.05)';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(0, scanY);
    ctx.lineTo(width, scanY);
    ctx.stroke();

    requestAnimationFrame(draw);
  }

  requestAnimationFrame(draw);

  // --- PERIODIC GLITCH BURST ENGINE ---
  function triggerRandomGlitchBurst() {
    const glitchElements = document.querySelectorAll('.cyber-glitch');
    if (glitchElements.length > 0) {
      const target = glitchElements[Math.floor(Math.random() * glitchElements.length)];
      target.classList.add('glitch-fire');
      playCyberBlip(1600, 'square', 0.04, 0.02);

      setTimeout(() => {
        target.classList.remove('glitch-fire');
      }, 300);
    }

    const nextDelay = 3500 + Math.random() * 3500;
    setTimeout(triggerRandomGlitchBurst, nextDelay);
  }

  // --- HIRO SPEECH BUBBLE & INTERACTION ---
  function setupHiroInteraction() {
    const badge = document.getElementById('hiro-badge-hud');
    const bubble = document.getElementById('hiro-speech-bubble');
    if (!badge || !bubble) return;

    const quotes = [
      'Koneksi Franxx stabil. Siap mendampingi pembukuan, Operator Bakpauu!',
      'Neraca lajur 10 kolom telah seimbang & tervalidasi. Code 016 standby!',
      'Buku besar dan transaksi jurnal sinkron dengan database akuntansi.',
      'Strelizia link operational 100%. Mari tuntaskan laporan keuangan ini!',
      'Akun 1, Akun 2, dan Akun 3 siap diposting ke jurnal penyesuaian.'
    ];

    let quoteIndex = 0;
    let bubbleTimeout = null;

    function showQuote() {
      bubble.textContent = quotes[quoteIndex];
      bubble.style.display = 'block';
      quoteIndex = (quoteIndex + 1) % quotes.length;
      playCyberBlip(1350, 'sine', 0.05, 0.04);

      if (bubbleTimeout) clearTimeout(bubbleTimeout);
      bubbleTimeout = setTimeout(() => {
        bubble.style.display = 'none';
      }, 5000);
    }

    badge.addEventListener('click', showQuote);
  }

  document.addEventListener('DOMContentLoaded', () => {
    setTimeout(triggerRandomGlitchBurst, 2500);
    setupHiroInteraction();

    // Sound feedback on button hover
    const buttons = document.querySelectorAll('.btn, .nav-link, .deck-tab-btn');
    buttons.forEach(btn => {
      btn.addEventListener('mouseenter', () => {
        playCyberBlip(950, 'sine', 0.03, 0.015);
      });
    });
  });
})();
