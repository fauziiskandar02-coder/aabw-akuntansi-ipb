/**
 * AABW 3D Cyber-Hologram Engine & Pilot Hiro (Code: 016)
 * Real-time 3D PBR Model generated from official Parasite Uniform turnaround art.
 * Features:
 * - High-Fidelity 3D Anime Pilot Hiro Model (Darling in the Franxx)
 * - Authentic Grey Parasite Uniform (#727982) with 016 Shield Badge & White Collar
 * - Signature Navy Blue Anime Spiky Hair & Turquoise Eyes
 * - Smooth Cursor-Tracking (Tilts & turns head/body towards pointer)
 * - 360° Drag-to-Rotate Orbit Interaction (Front, Profile, and Back uniform details)
 * - Zero-Gravity Floating Levitation & Breathing Animation
 * - Holographic Cyan Blueprint Projection Rings & Particle Field
 * - Dual-Viewport: Main Dashboard Command Deck + Floating Bottom-Right Companion Widget
 */

(function () {
  'use strict';

  // --- GLOBAL POINTER TRACKING ---
  let pointerX = 0;
  let pointerY = 0;

  window.addEventListener('mousemove', (e) => {
    pointerX = (e.clientX / window.innerWidth) * 2 - 1;
    pointerY = -(e.clientY / window.innerHeight) * 2 + 1;
  });

  // Determine base model URL
  function getModelUrl() {
    const metaBase = document.querySelector('meta[name="base-url"]');
    const baseUrl = metaBase ? metaBase.getAttribute('content').replace(/\/+$/, '') : '';
    return (baseUrl ? baseUrl : '') + '/template/assets/models/hiro.glb';
  }

  // Helper to ensure Three.js and GLTFLoader are available before executing
  function whenReady(callback) {
    if (typeof THREE !== 'undefined' && typeof THREE.GLTFLoader !== 'undefined') {
      callback();
    } else {
      let attempts = 0;
      const interval = setInterval(() => {
        attempts++;
        if (typeof THREE !== 'undefined' && typeof THREE.GLTFLoader !== 'undefined') {
          clearInterval(interval);
          callback();
        } else if (attempts > 50) {
          clearInterval(interval);
          console.warn('[Hiro 3D] Three.js or GLTFLoader failed to initialize within timeout.');
          const loadingEl = document.getElementById('hiro-3d-loading');
          if (loadingEl) loadingEl.style.display = 'none';
        }
      }, 100);
    }
  }

  // Helper to construct Holographic Tech Base Rings & Particles
  function createHoloBase(radius = 0.45) {
    const group = new THREE.Group();

    // Inner bright ring
    const innerRingGeo = new THREE.RingGeometry(radius * 0.75, radius * 0.82, 48);
    const innerRingMat = new THREE.MeshBasicMaterial({
      color: 0x00f0ff,
      side: THREE.DoubleSide,
      transparent: true,
      opacity: 0.70
    });
    const innerRing = new THREE.Mesh(innerRingGeo, innerRingMat);
    innerRing.rotation.x = Math.PI / 2;
    group.add(innerRing);

    // Outer subtle ring
    const outerRingGeo = new THREE.RingGeometry(radius * 0.95, radius * 1.02, 48);
    const outerRingMat = new THREE.MeshBasicMaterial({
      color: 0x38bdf8,
      side: THREE.DoubleSide,
      transparent: true,
      opacity: 0.35
    });
    const outerRing = new THREE.Mesh(outerRingGeo, outerRingMat);
    outerRing.rotation.x = Math.PI / 2;
    group.add(outerRing);

    // Ambient floating cyan particles
    const particleCount = 28;
    const particleGeo = new THREE.BufferGeometry();
    const particlePositions = new Float32Array(particleCount * 3);
    for (let i = 0; i < particleCount; i++) {
      const angle = Math.random() * Math.PI * 2;
      const r = radius * (0.3 + Math.random() * 0.85);
      particlePositions[i * 3 + 0] = Math.cos(angle) * r;
      particlePositions[i * 3 + 1] = Math.random() * 0.9;
      particlePositions[i * 3 + 2] = Math.sin(angle) * r;
    }
    particleGeo.setAttribute('position', new THREE.BufferAttribute(particlePositions, 3));
    const particleMat = new THREE.PointsMaterial({
      color: 0x38bdf8,
      size: 0.035,
      transparent: true,
      opacity: 0.65
    });
    const particles = new THREE.Points(particleGeo, particleMat);
    group.add(particles);

    return { group, innerRing, outerRing, particles };
  }

  // =========================================================================
  // 1. HERO DASHBOARD COMMAND DECK (Main Interactive 3D Viewport)
  // =========================================================================
  function initHeroHiroDeck() {
    const container = document.getElementById('hiro-hero-canvas-container');
    const loadingEl = document.getElementById('hiro-3d-loading');
    if (!container) return;

    container.innerHTML = '';

    const width = container.clientWidth || 400;
    const height = container.clientHeight || 320;

    const scene = new THREE.Scene();

    // Perspective camera framing Hiro from head to boots
    const camera = new THREE.PerspectiveCamera(38, width / height, 0.1, 50);
    camera.position.set(0, 0.62, 2.15);
    camera.lookAt(0, 0.58, 0);

    const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(width, height);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    if (renderer.outputColorSpace) {
      renderer.outputColorSpace = THREE.SRGBColorSpace;
    } else if (THREE.sRGBEncoding) {
      renderer.outputEncoding = THREE.sRGBEncoding;
    }
    container.appendChild(renderer.domElement);

    // Cyberpunk Studio Lighting
    const ambientLight = new THREE.AmbientLight(0xffffff, 1.25);
    scene.add(ambientLight);

    const keyLight = new THREE.DirectionalLight(0xffffff, 1.6);
    keyLight.position.set(2.5, 3.5, 3.0);
    scene.add(keyLight);

    const cyanRim = new THREE.DirectionalLight(0x00f0ff, 1.6);
    cyanRim.position.set(-3.0, 2.2, -1.8);
    scene.add(cyanRim);

    const blueBack = new THREE.DirectionalLight(0x3b82f6, 1.0);
    blueBack.position.set(2.5, -1.0, -2.0);
    scene.add(blueBack);

    // Holographic Projection Base
    const holo = createHoloBase(0.48);
    holo.group.position.set(0, 0.04, 0);
    scene.add(holo.group);

    // Pivot group for rotation & floating physics
    const pivot = new THREE.Group();
    scene.add(pivot);

    // Load Hiro 3D GLB Model
    const loader = new THREE.GLTFLoader();
    const modelUrl = getModelUrl();

    let modelLoaded = false;
    let hiroModel = null;

    loader.load(
      modelUrl,
      (gltf) => {
        hiroModel = gltf.scene;

        // Auto-center model at origin and adjust vertical offset
        const box = new THREE.Box3().setFromObject(hiroModel);
        const center = box.getCenter(new THREE.Vector3());

        hiroModel.position.x = -center.x;
        hiroModel.position.y = -center.y + 0.58;
        hiroModel.position.z = -center.z;

        // Tune materials for cyberpunk anime look
        hiroModel.traverse((child) => {
          if (child.isMesh && child.material) {
            child.material.side = THREE.DoubleSide;
            child.material.roughness = Math.min(child.material.roughness || 0.6, 0.55);
            child.material.metalness = Math.max(child.material.metalness || 0.05, 0.12);
          }
        });

        pivot.add(hiroModel);
        modelLoaded = true;

        // Fade out loading screen smoothly
        if (loadingEl) {
          loadingEl.style.transition = 'opacity 0.4s ease';
          loadingEl.style.opacity = '0';
          setTimeout(() => {
            loadingEl.style.display = 'none';
          }, 400);
        }
      },
      undefined,
      (error) => {
        console.error('[Hiro 3D] Failed to load 3D GLB model:', error);
        if (loadingEl) {
          loadingEl.innerHTML = '<span class="text-danger"><i class="fas fa-exclamation-triangle mr-1"></i> 3D Model Offline</span>';
        }
      }
    );

    // --- 360° INTERACTIVE DRAG TO ROTATE ---
    let isDragging = false;
    let previousX = 0;
    let dragAngle = 0;
    let dragVelocity = 0;

    container.addEventListener('mousedown', (e) => {
      isDragging = true;
      previousX = e.clientX;
      dragVelocity = 0;
      container.style.cursor = 'grabbing';
    });

    window.addEventListener('mouseup', () => {
      if (isDragging) {
        isDragging = false;
        container.style.cursor = 'grab';
      }
    });

    window.addEventListener('mousemove', (e) => {
      if (!isDragging) return;
      const deltaX = e.clientX - previousX;
      previousX = e.clientX;
      dragVelocity = deltaX * 0.012;
      dragAngle += dragVelocity;
    });

    container.addEventListener('touchstart', (e) => {
      if (e.touches.length === 1) {
        isDragging = true;
        previousX = e.touches[0].clientX;
        dragVelocity = 0;
      }
    }, { passive: true });

    window.addEventListener('touchmove', (e) => {
      if (!isDragging || e.touches.length !== 1) return;
      const deltaX = e.touches[0].clientX - previousX;
      previousX = e.touches[0].clientX;
      dragVelocity = deltaX * 0.012;
      dragAngle += dragVelocity;
    }, { passive: true });

    window.addEventListener('touchend', () => {
      isDragging = false;
    });

    // Responsive Canvas Resize
    window.addEventListener('resize', () => {
      if (!container) return;
      const newW = container.clientWidth || 400;
      const newH = container.clientHeight || 320;
      camera.aspect = newW / newH;
      camera.updateProjectionMatrix();
      renderer.setSize(newW, newH);
    });

    // --- ANIMATION LOOP (Tracking, Breathing, & Hologram FX) ---
    const clock = new THREE.Clock();
    let curRotY = 0;
    let curRotX = 0;
    let curRotZ = 0;

    function animate() {
      requestAnimationFrame(animate);
      const elapsed = clock.getElapsedTime();

      // Inertia dampening for drag
      if (!isDragging && Math.abs(dragVelocity) > 0.0001) {
        dragAngle += dragVelocity;
        dragVelocity *= 0.92;
      }

      if (modelLoaded && hiroModel) {
        // Zero-G levitation bobbing
        pivot.position.y = Math.sin(elapsed * 1.8) * 0.035;

        // Dynamic Cursor Tracking (Hiro smoothly turns head/body towards mouse pointer)
        const targetRotY = dragAngle + pointerX * 0.42;
        const targetRotX = -pointerY * 0.18;
        const targetRotZ = pointerX * 0.06;

        curRotY += (targetRotY - curRotY) * 0.07;
        curRotX += (targetRotX - curRotX) * 0.07;
        curRotZ += (targetRotZ - curRotZ) * 0.07;

        pivot.rotation.y = curRotY;
        pivot.rotation.x = curRotX;
        pivot.rotation.z = curRotZ;
      }

      // Holographic ring revolutions & particle motion
      holo.innerRing.rotation.z = elapsed * 0.65;
      holo.outerRing.rotation.z = -elapsed * 0.40;
      holo.particles.rotation.y = elapsed * 0.30;

      renderer.render(scene, camera);
    }

    animate();
  }

  // =========================================================================
  // 2. FLOATING COMMUNICATOR HUD WIDGET (Bottom-Right Companion Avatar)
  // =========================================================================
  function initHiroWidget() {
    const canvasBox = document.getElementById('hiro-canvas-box');
    if (!canvasBox) return;

    canvasBox.innerHTML = '';
    canvasBox.style.position = 'relative';
    canvasBox.style.overflow = 'hidden';

    const width = canvasBox.clientWidth || 78;
    const height = canvasBox.clientHeight || 78;

    const miniScene = new THREE.Scene();
    const miniCamera = new THREE.PerspectiveCamera(38, width / height, 0.1, 50);

    // Focused close-up framing squarely on Hiro's face & collar
    miniCamera.position.set(0, 0.88, 1.25);
    miniCamera.lookAt(0, 0.85, 0);

    const miniRenderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    miniRenderer.setSize(width, height);
    miniRenderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    if (miniRenderer.outputColorSpace) {
      miniRenderer.outputColorSpace = THREE.SRGBColorSpace;
    } else if (THREE.sRGBEncoding) {
      miniRenderer.outputEncoding = THREE.sRGBEncoding;
    }
    canvasBox.appendChild(miniRenderer.domElement);

    const miniAmbient = new THREE.AmbientLight(0xffffff, 1.2);
    miniScene.add(miniAmbient);

    const miniKeyLight = new THREE.DirectionalLight(0xffffff, 1.5);
    miniKeyLight.position.set(2, 3, 3);
    miniScene.add(miniKeyLight);

    const miniCyanLight = new THREE.DirectionalLight(0x00f0ff, 1.6);
    miniCyanLight.position.set(-2, 2, -1);
    miniScene.add(miniCyanLight);

    const miniPivot = new THREE.Group();
    miniScene.add(miniPivot);

    const loader = new THREE.GLTFLoader();
    const modelUrl = getModelUrl();
    let miniLoaded = false;
    let miniModel = null;

    loader.load(modelUrl, (gltf) => {
      miniModel = gltf.scene;

      const box = new THREE.Box3().setFromObject(miniModel);
      const center = box.getCenter(new THREE.Vector3());

      miniModel.position.x = -center.x;
      miniModel.position.y = -center.y + 0.58;
      miniModel.position.z = -center.z;

      miniPivot.add(miniModel);
      miniLoaded = true;
    });

    const clock = new THREE.Clock();
    let curMiniY = 0;
    let curMiniX = 0;

    function miniAnimate() {
      requestAnimationFrame(miniAnimate);
      const elapsed = clock.getElapsedTime();

      if (miniLoaded && miniModel) {
        // Subtle floating bob
        miniPivot.position.y = Math.sin(elapsed * 2.0) * 0.02;

        // Smooth head tracking towards cursor
        const targetY = pointerX * 0.38;
        const targetX = -pointerY * 0.15;
        curMiniY += (targetY - curMiniY) * 0.08;
        curMiniX += (targetX - curMiniX) * 0.08;

        miniPivot.rotation.y = curMiniY;
        miniPivot.rotation.x = curMiniX;
      }

      miniRenderer.render(miniScene, miniCamera);
    }

    miniAnimate();

    // Dialogue Bubble Interaction (English Pilot Communication System)
    const badgeHud = document.getElementById('hiro-badge-hud');
    const speechBubble = document.getElementById('hiro-speech-bubble');
    const dialogues = [
      'Accounting System Online. Ready for transaction data synchronization!',
      'All journal entries and accounting worksheet stable, Operator Bakpauu!',
      'Pilot 016 Hiro fully synchronized with neural link!',
      'Income Statement and Balance Sheet validated and balanced!',
      'Status: Ready to process new journal entries at any moment!'
    ];

    if (badgeHud && speechBubble) {
      let speechTimer = null;
      let quoteIdx = 0;

      function playAudioChirp() {
        try {
          const AudioContext = window.AudioContext || window.webkitAudioContext;
          if (!AudioContext) return;
          const ctx = new AudioContext();
          const osc = ctx.createOscillator();
          const gain = ctx.createGain();
          osc.type = 'sine';
          osc.frequency.setValueAtTime(1400, ctx.currentTime);
          osc.frequency.exponentialRampToValueAtTime(800, ctx.currentTime + 0.08);
          gain.gain.setValueAtTime(0.04, ctx.currentTime);
          gain.gain.linearRampToValueAtTime(0.001, ctx.currentTime + 0.08);
          osc.connect(gain);
          gain.connect(ctx.destination);
          osc.start();
          osc.stop(ctx.currentTime + 0.08);
        } catch (e) {}
      }

      badgeHud.addEventListener('click', () => {
        const quote = dialogues[quoteIdx];
        quoteIdx = (quoteIdx + 1) % dialogues.length;

        speechBubble.innerHTML = `<i class="fas fa-satellite-dish mr-1 text-cyan"></i> ${quote}`;
        speechBubble.style.display = 'block';
        speechBubble.classList.add('show');
        playAudioChirp();

        if (speechTimer) clearTimeout(speechTimer);
        speechTimer = setTimeout(() => {
          speechBubble.style.display = 'none';
          speechBubble.classList.remove('show');
        }, 5000);
      });
    }
  }

  // --- INITIALIZE ON DOM READY ---
  document.addEventListener('DOMContentLoaded', () => {
    whenReady(() => {
      initHeroHiroDeck();
      initHiroWidget();
    });
  });
})();
