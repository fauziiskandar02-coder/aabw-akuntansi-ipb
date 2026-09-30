/**
 * Hiro (Code: 016 - Darling in the Franxx) 3D Chibi Character Engine
 * Features:
 * - Iconic 3D Procedural Chibi Hiro Model (Franxx Pilot Suit, White Armor Plates, Cyan Core, Anime Hair & Blue Horns)
 * - Real-time Mouse / Cursor Head Tracking (Smooth Dampening)
 * - Interactive 360° Drag-to-Rotate Orbit Controls (Main Hero Viewport)
 * - Zero-Gravity Floating & Natural Breathing Physics
 * - Holographic Blueprint Rings & Orbiting Cybernetic Particles
 * - Interactive Mini Chibi Hiro Companion in Bottom-Right Floating HUD Orb
 * - English Pilot Communication Dialogue System
 */

(function () {
  'use strict';

  // --- MOUSE COORDINATE TRACKER ---
  let pointerX = 0;
  let pointerY = 0;

  window.addEventListener('mousemove', (e) => {
    pointerX = (e.clientX / window.innerWidth) * 2 - 1;
    pointerY = -(e.clientY / window.innerHeight) * 2 + 1;
  });

  // --- PROCEDURAL 3D CHIBI HIRO GENERATOR ---
  function createHiroMesh(isHero = false) {
    const group = new THREE.Group();

    // Stylized Cyber & Anime Materials
    const skinMat = new THREE.MeshStandardMaterial({
      color: 0xffe2d4,
      roughness: 0.55,
      metalness: 0.08
    });

    const hairMat = new THREE.MeshStandardMaterial({
      color: 0x0c1e3d, // Signature Dark Navy Hiro Anime Hair
      roughness: 0.38,
      metalness: 0.15
    });

    const suitDarkMat = new THREE.MeshStandardMaterial({
      color: 0x111c33, // Franxx Pilot Suit Slate Navy
      roughness: 0.35,
      metalness: 0.25
    });

    const suitWhiteMat = new THREE.MeshStandardMaterial({
      color: 0xf8fafc, // High-contrast Armor Chest Plates
      roughness: 0.25,
      metalness: 0.18
    });

    const cyanGlowMat = new THREE.MeshStandardMaterial({
      color: 0x00f0ff,
      emissive: 0x00d2ff,
      emissiveIntensity: 0.9,
      roughness: 0.1
    });

    const hornMat = new THREE.MeshStandardMaterial({
      color: 0x00f0ff,
      emissive: 0x00b4d8,
      emissiveIntensity: 1.0,
      transparent: true,
      opacity: 0.94,
      roughness: 0.1
    });

    const eyeMat = new THREE.MeshBasicMaterial({ color: 0x1e3a8a });
    const eyeHighlightMat = new THREE.MeshBasicMaterial({ color: 0x38bdf8 });

    // --- HEAD GROUP ---
    const headGroup = new THREE.Group();

    // Chibi Head Base (Smooth anime oval)
    const headGeo = new THREE.SphereGeometry(0.85, 32, 32);
    headGeo.scale(0.92, 1.04, 0.94);
    const headMesh = new THREE.Mesh(headGeo, skinMat);
    headMesh.castShadow = true;
    headGroup.add(headMesh);

    // Anime Eyes
    const eyeGeo = new THREE.SphereGeometry(0.12, 16, 16);
    eyeGeo.scale(1.2, 0.75, 0.4);

    const leftEye = new THREE.Mesh(eyeGeo, eyeMat);
    leftEye.position.set(-0.28, 0.05, 0.77);
    leftEye.rotation.y = -0.15;
    headGroup.add(leftEye);

    const leftHighlight = new THREE.Mesh(new THREE.SphereGeometry(0.045, 8, 8), eyeHighlightMat);
    leftHighlight.position.set(-0.25, 0.09, 0.81);
    headGroup.add(leftHighlight);

    const rightEye = new THREE.Mesh(eyeGeo, eyeMat);
    rightEye.position.set(0.28, 0.05, 0.77);
    rightEye.rotation.y = 0.15;
    headGroup.add(rightEye);

    const rightHighlight = new THREE.Mesh(new THREE.SphereGeometry(0.045, 8, 8), eyeHighlightMat);
    rightHighlight.position.set(0.25, 0.09, 0.81);
    headGroup.add(rightHighlight);

    // --- HAIR (Hiro's signature anime swept bangs & back) ---
    const hairGroup = new THREE.Group();

    // Main Scalp
    const scalpGeo = new THREE.SphereGeometry(0.92, 24, 24);
    scalpGeo.scale(0.96, 1.08, 1.0);
    const scalp = new THREE.Mesh(scalpGeo, hairMat);
    scalp.position.set(0, 0.15, -0.08);
    scalp.castShadow = true;
    hairGroup.add(scalp);

    // Front & Side Bang Strands
    const strandGeo = new THREE.ConeGeometry(0.18, 0.75, 5);
    strandGeo.rotateX(Math.PI);

    const bangs = [
      { pos: [-0.35, 0.55, 0.8], rot: [0.3, 0.2, 0.4] },
      { pos: [-0.15, 0.5, 0.88], rot: [0.35, 0.05, 0.1] },
      { pos: [0.08, 0.52, 0.89], rot: [0.35, -0.05, -0.1] },
      { pos: [0.32, 0.53, 0.82], rot: [0.3, -0.2, -0.35] },
      { pos: [-0.55, 0.35, 0.65], rot: [0.2, 0.5, 0.6] },
      { pos: [0.55, 0.35, 0.65], rot: [0.2, -0.5, -0.6] },
      // Back strands
      { pos: [-0.4, 0.2, -0.8], rot: [-0.4, 0.3, 0.3] },
      { pos: [0.4, 0.2, -0.8], rot: [-0.4, -0.3, -0.3] },
      { pos: [0.0, 0.15, -0.9], rot: [-0.5, 0.0, 0.0] }
    ];

    bangs.forEach((b) => {
      const strand = new THREE.Mesh(strandGeo, hairMat);
      strand.position.set(...b.pos);
      strand.rotation.set(...b.rot);
      strand.castShadow = true;
      hairGroup.add(strand);
    });

    headGroup.add(hairGroup);

    // --- BLUE ONI HORNS (Klaxosaur Awakening) ---
    const hornGeo = new THREE.ConeGeometry(0.08, 0.45, 16);
    hornGeo.rotateX(Math.PI / 4);

    const leftHorn = new THREE.Mesh(hornGeo, hornMat);
    leftHorn.position.set(-0.35, 0.78, 0.45);
    leftHorn.rotation.set(0.3, 0.2, -0.4);
    headGroup.add(leftHorn);

    const rightHorn = new THREE.Mesh(hornGeo, hornMat);
    rightHorn.position.set(0.35, 0.78, 0.45);
    rightHorn.rotation.set(0.3, -0.2, 0.4);
    headGroup.add(rightHorn);

    headGroup.position.y = 1.35;
    group.add(headGroup);

    // --- TORSO & FRANXX PILOT SUIT ---
    const torsoGroup = new THREE.Group();

    // Neck
    const neckGeo = new THREE.CylinderGeometry(0.32, 0.35, 0.4, 16);
    const neck = new THREE.Mesh(neckGeo, suitDarkMat);
    neck.position.y = 0.85;
    torsoGroup.add(neck);

    // Suit Chest / Upper Body
    const chestGeo = new THREE.CylinderGeometry(0.72, 0.58, 1.1, 16);
    const chest = new THREE.Mesh(chestGeo, suitDarkMat);
    chest.position.y = 0.25;
    chest.castShadow = true;
    torsoGroup.add(chest);

    // White Chest Armor Plate
    const plateGeo = new THREE.BoxGeometry(0.65, 0.6, 0.25);
    const plate = new THREE.Mesh(plateGeo, suitWhiteMat);
    plate.position.set(0, 0.35, 0.32);
    torsoGroup.add(plate);

    // Glowing Cyber Franxx Core (Code: 016)
    const coreGeo = new THREE.CylinderGeometry(0.12, 0.12, 0.08, 16);
    coreGeo.rotateX(Math.PI / 2);
    const core = new THREE.Mesh(coreGeo, cyanGlowMat);
    core.position.set(0, 0.35, 0.45);
    torsoGroup.add(core);

    // Shoulders
    const shoulderGeo = new THREE.SphereGeometry(0.32, 16, 16);
    const leftShoulder = new THREE.Mesh(shoulderGeo, suitWhiteMat);
    leftShoulder.position.set(-0.85, 0.55, 0.0);
    torsoGroup.add(leftShoulder);

    const rightShoulder = new THREE.Mesh(shoulderGeo, suitWhiteMat);
    rightShoulder.position.set(0.85, 0.55, 0.0);
    torsoGroup.add(rightShoulder);

    // Shoulder Cyan Trim Rings
    const trimGeo = new THREE.TorusGeometry(0.34, 0.03, 8, 24);
    const leftTrim = new THREE.Mesh(trimGeo, cyanGlowMat);
    leftTrim.position.set(-0.85, 0.55, 0.0);
    leftTrim.rotation.y = Math.PI / 2;
    torsoGroup.add(leftTrim);

    const rightTrim = new THREE.Mesh(trimGeo, cyanGlowMat);
    rightTrim.position.set(0.85, 0.55, 0.0);
    rightTrim.rotation.y = Math.PI / 2;
    torsoGroup.add(rightTrim);

    group.add(torsoGroup);

    // --- HOLOGRAPHIC BLUEPRINT RINGS ---
    const holoRingGeo = new THREE.RingGeometry(1.35, 1.42, 36);
    const holoRingMat = new THREE.MeshBasicMaterial({
      color: 0x00f0ff,
      side: THREE.DoubleSide,
      transparent: true,
      opacity: 0.65
    });
    const holoRing = new THREE.Mesh(holoRingGeo, holoRingMat);
    holoRing.rotation.x = Math.PI / 2;
    holoRing.position.y = -0.55;
    group.add(holoRing);

    const outerRingGeo = new THREE.RingGeometry(1.65, 1.70, 36);
    const outerRingMat = new THREE.MeshBasicMaterial({
      color: 0x3b82f6,
      side: THREE.DoubleSide,
      transparent: true,
      opacity: 0.45
    });
    const outerRing = new THREE.Mesh(outerRingGeo, outerRingMat);
    outerRing.rotation.x = Math.PI / 2;
    outerRing.position.y = -0.65;
    group.add(outerRing);

    // Orbiting Cyber Particles
    const particleCount = 28;
    const particleGeo = new THREE.BufferGeometry();
    const particlePositions = new Float32Array(particleCount * 3);

    for (let i = 0; i < particleCount; i++) {
      const angle = (i / particleCount) * Math.PI * 2;
      const r = 1.35 + Math.random() * 0.45;
      particlePositions[i * 3] = Math.cos(angle) * r;
      particlePositions[i * 3 + 1] = (Math.random() - 0.5) * 1.6;
      particlePositions[i * 3 + 2] = Math.sin(angle) * r;
    }

    particleGeo.setAttribute('position', new THREE.BufferAttribute(particlePositions, 3));
    const particleMat = new THREE.PointsMaterial({
      color: 0x38bdf8,
      size: 0.08,
      transparent: true,
      opacity: 0.75
    });
    const particles = new THREE.Points(particleGeo, particleMat);
    group.add(particles);

    return {
      group,
      headGroup,
      holoRing,
      outerRing,
      particles
    };
  }

  // --- 1. MAIN HERO OPERATOR DECK (Home Dashboard) ---
  function initHeroHiroDeck() {
    const container = document.getElementById('hiro-hero-canvas-container');
    const loadingEl = document.getElementById('hiro-3d-loading');
    if (!container || typeof THREE === 'undefined') return;

    container.innerHTML = '';

    const width = container.clientWidth || 400;
    const height = container.clientHeight || 320;

    const scene = new THREE.Scene();

    // Camera framed centered on Chibi Hiro
    const camera = new THREE.PerspectiveCamera(40, width / height, 0.1, 50);
    camera.position.set(0, 0.95, 3.8);
    camera.lookAt(0, 0.95, 0);

    const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(width, height);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.outputEncoding = THREE.sRGBEncoding || 3001;
    container.appendChild(renderer.domElement);

    // Cybernetic Lighting
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.95);
    scene.add(ambientLight);

    const keyLight = new THREE.DirectionalLight(0xffffff, 1.2);
    keyLight.position.set(2.5, 3.5, 3.0);
    scene.add(keyLight);

    const cyanRim = new THREE.DirectionalLight(0x00f0ff, 1.5);
    cyanRim.position.set(-3.0, 2.0, -1.8);
    scene.add(cyanRim);

    const backRim = new THREE.DirectionalLight(0x3b82f6, 0.9);
    backRim.position.set(3.0, -1.0, -1.8);
    scene.add(backRim);

    const hiro = createHiroMesh(true);
    hiro.group.scale.set(1.22, 1.22, 1.22);
    hiro.group.position.set(0, 0, 0);
    scene.add(hiro.group);

    // Instantly hide loading overlay
    if (loadingEl) {
      loadingEl.style.transition = 'opacity 0.3s ease';
      loadingEl.style.opacity = '0';
      setTimeout(() => {
        loadingEl.style.display = 'none';
      }, 300);
    }

    // --- INTERACTION: 360° DRAG TO ROTATE ---
    let isDragging = false;
    let previousX = 0;
    let rotationY = 0;

    container.addEventListener('mousedown', (e) => {
      isDragging = true;
      previousX = e.clientX;
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
      rotationY += deltaX * 0.012;
      hiro.group.rotation.y = rotationY;
    });

    container.addEventListener('touchstart', (e) => {
      if (e.touches.length === 1) {
        isDragging = true;
        previousX = e.touches[0].clientX;
      }
    }, { passive: true });

    window.addEventListener('touchmove', (e) => {
      if (!isDragging || e.touches.length !== 1) return;
      const deltaX = e.touches[0].clientX - previousX;
      previousX = e.touches[0].clientX;
      rotationY += deltaX * 0.012;
      hiro.group.rotation.y = rotationY;
    }, { passive: true });

    window.addEventListener('touchend', () => {
      isDragging = false;
    });

    // Responsive Resize
    window.addEventListener('resize', () => {
      if (!container) return;
      const newW = container.clientWidth || 400;
      const newH = container.clientHeight || 320;
      camera.aspect = newW / newH;
      camera.updateProjectionMatrix();
      renderer.setSize(newW, newH);
    });

    // --- ANIMATION LOOP ---
    const clock = new THREE.Clock();
    let curHeadY = 0;
    let curHeadX = 0;

    function animate() {
      requestAnimationFrame(animate);
      const elapsed = clock.getElapsedTime();

      // Zero-Gravity Floating & Breathing Physics
      hiro.group.position.y = Math.sin(elapsed * 1.9) * 0.07;

      // Smooth Head Tracking to mouse cursor
      const targetHeadY = pointerX * 0.42;
      const targetHeadX = -pointerY * 0.28;
      curHeadY += (targetHeadY - curHeadY) * 0.08;
      curHeadX += (targetHeadX - curHeadX) * 0.08;

      hiro.headGroup.rotation.y = curHeadY;
      hiro.headGroup.rotation.x = curHeadX;

      // Spin Holographic Rings & Orbiting Particles
      hiro.holoRing.rotation.z = elapsed * 0.7;
      hiro.outerRing.rotation.z = -elapsed * 0.45;
      hiro.particles.rotation.y = elapsed * 0.35;

      renderer.render(scene, camera);
    }

    animate();
  }

  // --- 2. FLOATING COMMUNICATOR WIDGET (Bottom-Right Chibi Hiro Companion) ---
  function initHiroWidget() {
    const canvasBox = document.getElementById('hiro-canvas-box');
    if (!canvasBox || typeof THREE === 'undefined') return;

    canvasBox.innerHTML = '';
    canvasBox.style.position = 'relative';
    canvasBox.style.overflow = 'hidden';

    const width = canvasBox.clientWidth || 78;
    const height = canvasBox.clientHeight || 78;

    const miniScene = new THREE.Scene();
    const miniCamera = new THREE.PerspectiveCamera(45, width / height, 0.1, 50);
    // Camera focused squarely on Hiro's chibi bust & horns
    miniCamera.position.set(0, 1.05, 3.1);
    miniCamera.lookAt(0, 1.0, 0);

    const miniRenderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    miniRenderer.setSize(width, height);
    miniRenderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    canvasBox.appendChild(miniRenderer.domElement);

    // Holographic Lighting
    const miniAmbient = new THREE.AmbientLight(0xffffff, 0.9);
    miniScene.add(miniAmbient);

    const miniCyanLight = new THREE.PointLight(0x00f0ff, 2.5, 6);
    miniCyanLight.position.set(0, 1.4, 1.5);
    miniScene.add(miniCyanLight);

    const miniKeyLight = new THREE.DirectionalLight(0xffffff, 1.2);
    miniKeyLight.position.set(2, 3, 3);
    miniScene.add(miniKeyLight);

    const miniHiro = createHiroMesh(false);
    miniHiro.group.scale.set(0.85, 0.85, 0.85);
    miniScene.add(miniHiro.group);

    const miniClock = new THREE.Clock();
    let miniCurHeadY = 0;

    function miniAnimate() {
      requestAnimationFrame(miniAnimate);
      const elapsed = miniClock.getElapsedTime();

      // Gentle floating levitation
      miniHiro.group.position.y = Math.sin(elapsed * 2.2) * 0.05;

      // Turn towards cursor
      const targetY = pointerX * 0.40;
      miniCurHeadY += (targetY - miniCurHeadY) * 0.08;
      miniHiro.headGroup.rotation.y = miniCurHeadY;

      // Spin holographic tech rings
      miniHiro.holoRing.rotation.z = elapsed * 0.8;
      miniHiro.outerRing.rotation.z = -elapsed * 0.5;
      miniHiro.particles.rotation.y = elapsed * 0.4;

      miniRenderer.render(miniScene, miniCamera);
    }

    miniAnimate();

    // Dialogue Bubble Interaction (English Pilot Communication System)
    const badgeHud = document.getElementById('hiro-badge-hud');
    const speechBubble = document.getElementById('hiro-speech-bubble');
    const dialogues = [
      'Accounting System Online. Ready for transaction data synchronization!',
      'All journal entries and 10-column worksheet stable, Operator Bakpauu!',
      'Pilot 016 Hiro fully synchronized with neural link!',
      'Income Statement and Balance Sheet validated and balanced!',
      'Status: Ready to process new journal entries at any moment!'
    ];

    if (badgeHud && speechBubble) {
      let speechTimer = null;
      badgeHud.addEventListener('click', () => {
        const randomQuote = dialogues[Math.floor(Math.random() * dialogues.length)];
        speechBubble.innerHTML = `<i class="fas fa-comment-dots mr-1 text-cyan"></i> ${randomQuote}`;
        speechBubble.classList.add('show');

        clearTimeout(speechTimer);
        speechTimer = setTimeout(() => {
          speechBubble.classList.remove('show');
        }, 4500);
      });
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    initHeroHiroDeck();
    initHiroWidget();
  });
})();
