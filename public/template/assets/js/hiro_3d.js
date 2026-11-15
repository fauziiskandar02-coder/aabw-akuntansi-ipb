/**
 * AABW 3D Operator Model Engine & Chibi Hiro Pilot (Code: 016)
 * Accurate Reproduction of Hiro's Official Parasite Uniform (Darling in the Franxx)
 * Features:
 * - Authentic Grey Parasite Uniform (#727982) with White Cross/Star Chest Insignia
 * - High Standing White Collar with Dark Lining
 * - Left-Chest Official Shield Badge "016" (Dynamic Canvas Texture)
 * - Signature Navy Blue Anime Spiky Hair with Layered Bangs & Back Tufts (Human Form, No Horns)
 * - Folded-Arms Pilot Stance with Charcoal Trousers & Tactical Boots
 * - Real-Time Head Tracking following Cursor Pointer
 * - 360° Interactive Orbit Drag to inspect Front, Side, and Back
 * - Zero-Gravity Floating Levitation & Holographic Blueprint Base
 */

(function () {
  'use strict';

  let pointerX = 0;
  let pointerY = 0;

  window.addEventListener('mousemove', (e) => {
    pointerX = (e.clientX / window.innerWidth) * 2 - 1;
    pointerY = -(e.clientY / window.innerHeight) * 2 + 1;
  });

  // --- HELPER: DYNAMIC 2D CANVAS TEXTURE FOR 016 SHIELD BADGE ---
  function createBadgeTexture() {
    const canvas = document.createElement('canvas');
    canvas.width = 128;
    canvas.height = 128;
    const ctx = canvas.getContext('2d');

    // Shield background
    ctx.fillStyle = '#2b313a';
    ctx.beginPath();
    ctx.moveTo(18, 16);
    ctx.lineTo(110, 16);
    ctx.lineTo(110, 72);
    ctx.lineTo(64, 114);
    ctx.lineTo(18, 72);
    ctx.closePath();
    ctx.fill();

    // Shield border
    ctx.strokeStyle = '#f8fafc';
    ctx.lineWidth = 6;
    ctx.stroke();

    // Wing chevron accent
    ctx.strokeStyle = '#94a3b8';
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.moveTo(26, 36);
    ctx.lineTo(64, 52);
    ctx.lineTo(102, 36);
    ctx.stroke();

    // Number "016"
    ctx.fillStyle = '#ffffff';
    ctx.font = 'bold 38px "JetBrains Mono", sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText('016', 64, 76);

    const texture = new THREE.CanvasTexture(canvas);
    texture.anisotropy = 4;
    return texture;
  }

  // --- ACCURATE 3D HIRO PARASITE UNIFORM GENERATOR ---
  function createHiroMesh(isHero = false) {
    const group = new THREE.Group();

    // --- MATERIALS PALETTE (Accurate to Reference Turnaround Sheet) ---
    const skinMat = new THREE.MeshStandardMaterial({
      color: 0xffe3d5,
      roughness: 0.52,
      metalness: 0.05
    });

    const hairMat = new THREE.MeshStandardMaterial({
      color: 0x14213d, // Signature Hiro Deep Midnight Navy Hair
      roughness: 0.42,
      metalness: 0.12
    });

    const jacketGreyMat = new THREE.MeshStandardMaterial({
      color: 0x737b85, // Official Parasite Uniform Slate Grey
      roughness: 0.48,
      metalness: 0.15
    });

    const trouserDarkMat = new THREE.MeshStandardMaterial({
      color: 0x444a53, // Dark Slate Grey Trousers
      roughness: 0.55,
      metalness: 0.12
    });

    const whiteTrimMat = new THREE.MeshStandardMaterial({
      color: 0xf8fafc, // High-contrast White Collar & Star Chest Insignia
      roughness: 0.32,
      metalness: 0.18
    });

    const cuffBlackMat = new THREE.MeshStandardMaterial({
      color: 0x1c2128, // Black Wrist Cuffs & Inner Collar
      roughness: 0.45,
      metalness: 0.20
    });

    const bootBlackMat = new THREE.MeshStandardMaterial({
      color: 0x22272e, // High Tactical Military Boots
      roughness: 0.42,
      metalness: 0.22
    });

    const eyeMat = new THREE.MeshBasicMaterial({ color: 0x1d4ed8 });
    const eyeHighlightMat = new THREE.MeshBasicMaterial({ color: 0x38bdf8 });
    const eyePupilMat = new THREE.MeshBasicMaterial({ color: 0x0f172a });

    const badgeMat = new THREE.MeshBasicMaterial({
      map: createBadgeTexture(),
      transparent: true,
      side: THREE.DoubleSide
    });

    // =========================================================================
    // 1. HEAD & ANIME FACE (Human Form, No Horns)
    // =========================================================================
    const headGroup = new THREE.Group();

    // Head Base (Smooth anime oval with chin definition)
    const headGeo = new THREE.SphereGeometry(0.85, 32, 32);
    headGeo.scale(0.92, 1.05, 0.94);
    const headMesh = new THREE.Mesh(headGeo, skinMat);
    headMesh.castShadow = true;
    headGroup.add(headMesh);

    // Subtle Chin Taper
    const chinGeo = new THREE.ConeGeometry(0.35, 0.35, 16);
    chinGeo.rotateX(Math.PI);
    const chin = new THREE.Mesh(chinGeo, skinMat);
    chin.position.set(0, -0.68, 0.42);
    chin.scale.set(0.9, 0.7, 0.6);
    headGroup.add(chin);

    // Anime Eyes (Left & Right)
    const eyeGeo = new THREE.SphereGeometry(0.12, 16, 16);
    eyeGeo.scale(1.2, 0.75, 0.38);

    // Left Eye
    const leftEye = new THREE.Mesh(eyeGeo, eyeMat);
    leftEye.position.set(-0.28, 0.05, 0.78);
    leftEye.rotation.y = -0.15;
    headGroup.add(leftEye);

    const leftPupil = new THREE.Mesh(new THREE.SphereGeometry(0.065, 8, 8), eyePupilMat);
    leftPupil.position.set(-0.28, 0.05, 0.82);
    headGroup.add(leftPupil);

    const leftHighlight = new THREE.Mesh(new THREE.SphereGeometry(0.045, 8, 8), eyeHighlightMat);
    leftHighlight.position.set(-0.24, 0.09, 0.83);
    headGroup.add(leftHighlight);

    // Right Eye
    const rightEye = new THREE.Mesh(eyeGeo, eyeMat);
    rightEye.position.set(0.28, 0.05, 0.78);
    rightEye.rotation.y = 0.15;
    headGroup.add(rightEye);

    const rightPupil = new THREE.Mesh(new THREE.SphereGeometry(0.065, 8, 8), eyePupilMat);
    rightPupil.position.set(0.28, 0.05, 0.82);
    headGroup.add(rightPupil);

    const rightHighlight = new THREE.Mesh(new THREE.SphereGeometry(0.045, 8, 8), eyeHighlightMat);
    rightHighlight.position.set(0.24, 0.09, 0.83);
    headGroup.add(rightHighlight);

    // Anime Eyebrows
    const browGeo = new THREE.BoxGeometry(0.22, 0.035, 0.06);
    const leftBrow = new THREE.Mesh(browGeo, hairMat);
    leftBrow.position.set(-0.28, 0.22, 0.80);
    leftBrow.rotation.z = -0.12;
    headGroup.add(leftBrow);

    const rightBrow = new THREE.Mesh(browGeo, hairMat);
    rightBrow.position.set(0.28, 0.22, 0.80);
    rightBrow.rotation.z = 0.12;
    headGroup.add(rightBrow);

    // =========================================================================
    // 2. SIGNATURE ANIME HAIR (Hiro's Spiky Navy Hair & Bangs)
    // =========================================================================
    const hairGroup = new THREE.Group();

    // Main Scalp Hemisphere
    const scalpGeo = new THREE.SphereGeometry(0.92, 28, 28);
    scalpGeo.scale(0.98, 1.10, 1.02);
    const scalp = new THREE.Mesh(scalpGeo, hairMat);
    scalp.position.set(0, 0.16, -0.06);
    scalp.castShadow = true;
    hairGroup.add(scalp);

    // Spiky Bang Strands (Front, Sides, & Back Tufts)
    const strandGeo = new THREE.ConeGeometry(0.18, 0.78, 5);
    strandGeo.rotateX(Math.PI);

    const hairStrands = [
      // Front Bangs framing face
      { pos: [0.0, 0.52, 0.90], rot: [0.38, 0.0, 0.0], scale: [1.1, 1.1, 1.1] },
      { pos: [-0.18, 0.50, 0.88], rot: [0.35, 0.10, 0.15], scale: [1.0, 1.0, 1.0] },
      { pos: [0.18, 0.50, 0.88], rot: [0.35, -0.10, -0.15], scale: [1.0, 1.0, 1.0] },
      { pos: [-0.36, 0.52, 0.82], rot: [0.32, 0.22, 0.35], scale: [1.0, 1.0, 1.0] },
      { pos: [0.36, 0.52, 0.82], rot: [0.32, -0.22, -0.35], scale: [1.0, 1.0, 1.0] },

      // Sideburns framing cheeks
      { pos: [-0.60, 0.32, 0.62], rot: [0.22, 0.55, 0.65], scale: [1.1, 1.2, 1.0] },
      { pos: [0.60, 0.32, 0.62], rot: [0.22, -0.55, -0.65], scale: [1.1, 1.2, 1.0] },

      // Crown & Back Spikes (Signature Anime Silhouette from side & back view)
      { pos: [0.0, 0.95, 0.10], rot: [-0.20, 0.0, 0.0], scale: [1.1, 1.0, 1.0] },
      { pos: [-0.35, 0.88, -0.15], rot: [-0.30, 0.25, 0.30], scale: [1.0, 1.0, 1.0] },
      { pos: [0.35, 0.88, -0.15], rot: [-0.30, -0.25, -0.30], scale: [1.0, 1.0, 1.0] },
      { pos: [-0.48, 0.40, -0.70], rot: [-0.45, 0.35, 0.40], scale: [1.1, 1.1, 1.1] },
      { pos: [0.48, 0.40, -0.70], rot: [-0.45, -0.35, -0.40], scale: [1.1, 1.1, 1.1] },
      { pos: [0.0, 0.32, -0.88], rot: [-0.60, 0.0, 0.0], scale: [1.2, 1.2, 1.1] },
      { pos: [-0.25, 0.15, -0.85], rot: [-0.65, 0.20, 0.20], scale: [1.0, 1.1, 1.0] },
      { pos: [0.25, 0.15, -0.85], rot: [-0.65, -0.20, -0.20], scale: [1.0, 1.1, 1.0] },
    ];

    hairStrands.forEach((b) => {
      const strand = new THREE.Mesh(strandGeo, hairMat);
      strand.position.set(...b.pos);
      strand.rotation.set(...b.rot);
      strand.scale.set(...b.scale);
      strand.castShadow = true;
      hairGroup.add(strand);
    });

    headGroup.add(hairGroup);
    headGroup.position.y = 1.35;
    group.add(headGroup);

    // =========================================================================
    // 3. TORSO & PARASITE GREY UNIFORM (Accurate to Reference)
    // =========================================================================
    const torsoGroup = new THREE.Group();

    // High Standing White Collar
    const collarGeo = new THREE.CylinderGeometry(0.36, 0.38, 0.45, 16);
    const collar = new THREE.Mesh(collarGeo, whiteTrimMat);
    collar.position.y = 0.88;
    torsoGroup.add(collar);

    // Inner Black Collar Lining
    const innerCollarGeo = new THREE.CylinderGeometry(0.34, 0.36, 0.47, 16);
    const innerCollar = new THREE.Mesh(innerCollarGeo, cuffBlackMat);
    innerCollar.position.y = 0.88;
    torsoGroup.add(innerCollar);

    // Main Uniform Jacket (Slate Grey #737b85)
    const jacketGeo = new THREE.CylinderGeometry(0.74, 0.62, 1.22, 16);
    const jacket = new THREE.Mesh(jacketGeo, jacketGreyMat);
    jacket.position.y = 0.24;
    jacket.castShadow = true;
    torsoGroup.add(jacket);

    // Pointed Jacket Bottom Hem (V-cut in front & back)
    const hemGeo = new THREE.ConeGeometry(0.63, 0.32, 16);
    hemGeo.rotateX(Math.PI);
    const hem = new THREE.Mesh(hemGeo, jacketGreyMat);
    hem.position.set(0, -0.42, 0.0);
    torsoGroup.add(hem);

    // White Shoulder Epaulette Tabs (Both Sides)
    const epauletteGeo = new THREE.BoxGeometry(0.32, 0.08, 0.42);
    const leftEpaulette = new THREE.Mesh(epauletteGeo, whiteTrimMat);
    leftEpaulette.position.set(-0.72, 0.62, 0.0);
    torsoGroup.add(leftEpaulette);

    const rightEpaulette = new THREE.Mesh(epauletteGeo, whiteTrimMat);
    rightEpaulette.position.set(0.72, 0.62, 0.0);
    torsoGroup.add(rightEpaulette);

    // Front White Cross / Chevron Star Insignia (Signature Franxx Uniform Chest Emblem)
    const crossBarGeo = new THREE.BoxGeometry(0.68, 0.11, 0.05);
    const leftCross = new THREE.Mesh(crossBarGeo, whiteTrimMat);
    leftCross.position.set(0, 0.42, 0.36);
    leftCross.rotation.z = Math.PI / 4.5;
    torsoGroup.add(leftCross);

    const rightCross = new THREE.Mesh(crossBarGeo, whiteTrimMat);
    rightCross.position.set(0, 0.42, 0.36);
    rightCross.rotation.z = -Math.PI / 4.5;
    torsoGroup.add(rightCross);

    // Center Diamond of the Star Emblem
    const diamondGeo = new THREE.BoxGeometry(0.24, 0.24, 0.06);
    diamondGeo.rotateZ(Math.PI / 4);
    const diamond = new THREE.Mesh(diamondGeo, whiteTrimMat);
    diamond.position.set(0, 0.42, 0.38);
    torsoGroup.add(diamond);

    // OFFICIAL 016 SHIELD BADGE (Positioned on Left Chest)
    const badgeGeo = new THREE.PlaneGeometry(0.26, 0.26);
    const badge = new THREE.Mesh(badgeGeo, badgeMat);
    badge.position.set(-0.34, 0.42, 0.39);
    badge.rotation.y = -0.12;
    torsoGroup.add(badge);

    // =========================================================================
    // 4. ARMS & FOLDED-ARMS POSE (Hiro's Signature Stance)
    // =========================================================================
    // Shoulders
    const shoulderGeo = new THREE.SphereGeometry(0.28, 16, 16);
    const leftShoulder = new THREE.Mesh(shoulderGeo, jacketGreyMat);
    leftShoulder.position.set(-0.80, 0.50, 0.05);
    torsoGroup.add(leftShoulder);

    const rightShoulder = new THREE.Mesh(shoulderGeo, jacketGreyMat);
    rightShoulder.position.set(0.80, 0.50, 0.05);
    torsoGroup.add(rightShoulder);

    // Upper Arms Angled Inwards
    const upperArmGeo = new THREE.CylinderGeometry(0.18, 0.16, 0.65, 12);

    const leftUpperArm = new THREE.Mesh(upperArmGeo, jacketGreyMat);
    leftUpperArm.position.set(-0.76, 0.22, 0.18);
    leftUpperArm.rotation.set(0.40, 0.15, -0.35);
    torsoGroup.add(leftUpperArm);

    const rightUpperArm = new THREE.Mesh(upperArmGeo, jacketGreyMat);
    rightUpperArm.position.set(0.76, 0.22, 0.18);
    rightUpperArm.rotation.set(0.40, -0.15, 0.35);
    torsoGroup.add(rightUpperArm);

    // Folded Forearms Across Chest
    const forearmGeo = new THREE.CylinderGeometry(0.16, 0.15, 0.76, 12);
    forearmGeo.rotateZ(Math.PI / 2);

    // Left Forearm (Crossed top)
    const leftForearm = new THREE.Mesh(forearmGeo, jacketGreyMat);
    leftForearm.position.set(0.04, 0.08, 0.48);
    leftForearm.rotation.set(0.12, 0.08, -0.06);
    torsoGroup.add(leftForearm);

    // Right Forearm (Crossed bottom)
    const rightForearm = new THREE.Mesh(forearmGeo, jacketGreyMat);
    rightForearm.position.set(-0.04, -0.05, 0.44);
    rightForearm.rotation.set(0.12, -0.08, 0.06);
    torsoGroup.add(rightForearm);

    // Black Wrist Cuffs (Both Wrists)
    const cuffGeo = new THREE.CylinderGeometry(0.175, 0.175, 0.14, 12);
    cuffGeo.rotateZ(Math.PI / 2);

    const leftCuff = new THREE.Mesh(cuffGeo, cuffBlackMat);
    leftCuff.position.set(-0.36, 0.08, 0.48);
    torsoGroup.add(leftCuff);

    const rightCuff = new THREE.Mesh(cuffGeo, cuffBlackMat);
    rightCuff.position.set(0.36, -0.05, 0.44);
    torsoGroup.add(rightCuff);

    group.add(torsoGroup);

    // =========================================================================
    // 5. TROUSERS & TACTICAL BOOTS (Lower Body)
    // =========================================================================
    const lowerBodyGroup = new THREE.Group();

    // Hips / Pelvis
    const hipsGeo = new THREE.CylinderGeometry(0.60, 0.54, 0.38, 16);
    const hips = new THREE.Mesh(hipsGeo, trouserDarkMat);
    hips.position.y = -0.56;
    lowerBodyGroup.add(hips);

    // Legs (Left & Right Trousers)
    const legGeo = new THREE.CylinderGeometry(0.20, 0.17, 1.15, 12);

    const leftLeg = new THREE.Mesh(legGeo, trouserDarkMat);
    leftLeg.position.set(-0.24, -1.22, 0.0);
    lowerBodyGroup.add(leftLeg);

    const rightLeg = new THREE.Mesh(legGeo, trouserDarkMat);
    rightLeg.position.set(0.24, -1.22, 0.0);
    lowerBodyGroup.add(rightLeg);

    // Tactical High Boots (Black & Charcoal)
    const bootShaftGeo = new THREE.CylinderGeometry(0.19, 0.18, 0.65, 12);

    const leftBootShaft = new THREE.Mesh(bootShaftGeo, bootBlackMat);
    leftBootShaft.position.set(-0.24, -1.82, 0.0);
    lowerBodyGroup.add(leftBootShaft);

    const rightBootShaft = new THREE.Mesh(bootShaftGeo, bootBlackMat);
    rightBootShaft.position.set(0.24, -1.82, 0.0);
    lowerBodyGroup.add(rightBootShaft);

    // Boot Soles & Feet
    const bootFootGeo = new THREE.BoxGeometry(0.25, 0.20, 0.48);

    const leftBootFoot = new THREE.Mesh(bootFootGeo, bootBlackMat);
    leftBootFoot.position.set(-0.24, -2.12, 0.10);
    lowerBodyGroup.add(leftBootFoot);

    const rightBootFoot = new THREE.Mesh(bootFootGeo, bootBlackMat);
    rightBootFoot.position.set(0.24, -2.12, 0.10);
    lowerBodyGroup.add(rightBootFoot);

    group.add(lowerBodyGroup);

    // =========================================================================
    // 6. HOLOGRAPHIC BLUEPRINT BASE & CYBER PARTICLES
    // =========================================================================
    const holoRingGeo = new THREE.RingGeometry(1.35, 1.42, 36);
    const holoRingMat = new THREE.MeshBasicMaterial({
      color: 0x00f0ff,
      side: THREE.DoubleSide,
      transparent: true,
      opacity: 0.65
    });
    const holoRing = new THREE.Mesh(holoRingGeo, holoRingMat);
    holoRing.rotation.x = Math.PI / 2;
    holoRing.position.y = -2.25;
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
    outerRing.position.y = -2.32;
    group.add(outerRing);

    // Orbiting Cyber Particles
    const particleCount = 28;
    const particleGeo = new THREE.BufferGeometry();
    const particlePositions = new Float32Array(particleCount * 3);

    for (let i = 0; i < particleCount; i++) {
      const angle = (i / particleCount) * Math.PI * 2;
      const r = 1.35 + Math.random() * 0.45;
      particlePositions[i * 3] = Math.cos(angle) * r;
      particlePositions[i * 3 + 1] = (Math.random() - 0.5) * 2.5 - 0.5;
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

  // =========================================================================
  // 7. HERO DASHBOARD OPERATOR DECK (Interactive Three.js Viewport)
  // =========================================================================
  function initHeroHiroDeck() {
    const container = document.getElementById('hiro-hero-canvas-container');
    const loadingEl = document.getElementById('hiro-3d-loading');
    if (!container || typeof THREE === 'undefined') return;

    container.innerHTML = '';

    const width = container.clientWidth || 400;
    const height = container.clientHeight || 320;

    const scene = new THREE.Scene();

    // Camera framed on Hiro's upper body & face (from waist up to head)
    const camera = new THREE.PerspectiveCamera(40, width / height, 0.1, 50);
    camera.position.set(0, 0.75, 3.8);
    camera.lookAt(0, 0.65, 0);

    const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(width, height);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    if (THREE.sRGBEncoding) {
      renderer.outputEncoding = THREE.sRGBEncoding;
    }
    container.appendChild(renderer.domElement);

    // Natural Anime Studio Lighting
    const ambientLight = new THREE.AmbientLight(0xffffff, 1.05);
    scene.add(ambientLight);

    const keyLight = new THREE.DirectionalLight(0xffffff, 1.25);
    keyLight.position.set(2.5, 3.5, 3.0);
    scene.add(keyLight);

    const cyanRim = new THREE.DirectionalLight(0x00f0ff, 1.35);
    cyanRim.position.set(-3.0, 2.0, -1.8);
    scene.add(cyanRim);

    const backRim = new THREE.DirectionalLight(0x3b82f6, 0.85);
    backRim.position.set(3.0, -1.0, -1.8);
    scene.add(backRim);

    const hiro = createHiroMesh(true);
    hiro.group.scale.set(1.08, 1.08, 1.08);
    hiro.group.position.set(0, -0.25, 0);
    scene.add(hiro.group);

    // Instantly hide loading overlay
    if (loadingEl) {
      loadingEl.style.transition = 'opacity 0.3s ease';
      loadingEl.style.opacity = '0';
      setTimeout(() => {
        loadingEl.style.display = 'none';
      }, 300);
    }

    // --- INTERACTION: 360° DRAG TO ROTATE (Inspect Front, Side, & Back) ---
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

    // --- ANIMATION LOOP (Head-Tracking & Levitation) ---
    const clock = new THREE.Clock();
    let curHeadY = 0;
    let curHeadX = 0;

    function animate() {
      requestAnimationFrame(animate);
      const elapsed = clock.getElapsedTime();

      // Zero-Gravity Floating & Breathing Physics
      hiro.group.position.y = -0.25 + Math.sin(elapsed * 1.8) * 0.05;

      // Smooth Dynamic Head Tracking following Cursor Pointer
      const targetHeadY = pointerX * 0.42;
      const targetHeadX = -pointerY * 0.28;
      curHeadY += (targetHeadY - curHeadY) * 0.08;
      curHeadX += (targetHeadX - curHeadX) * 0.08;

      hiro.headGroup.rotation.y = curHeadY;
      hiro.headGroup.rotation.x = curHeadX;

      // Spin Holographic Tech Rings & Particles
      hiro.holoRing.rotation.z = elapsed * 0.7;
      hiro.outerRing.rotation.z = -elapsed * 0.45;
      hiro.particles.rotation.y = elapsed * 0.35;

      renderer.render(scene, camera);
    }

    animate();
  }

  // =========================================================================
  // 8. FLOATING COMMUNICATOR WIDGET (Bottom-Right Companion)
  // =========================================================================
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
    // Camera focused squarely on Hiro's face & collar
    miniCamera.position.set(0, 1.25, 2.7);
    miniCamera.lookAt(0, 1.25, 0);

    const miniRenderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    miniRenderer.setSize(width, height);
    miniRenderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    canvasBox.appendChild(miniRenderer.domElement);

    const miniAmbient = new THREE.AmbientLight(0xffffff, 1.0);
    miniScene.add(miniAmbient);

    const miniCyanLight = new THREE.PointLight(0x00f0ff, 2.0, 6);
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
      miniHiro.group.position.y = Math.sin(elapsed * 2.2) * 0.04;

      // Turn head towards cursor
      const targetY = pointerX * 0.38;
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
      'All journal entries and accounting worksheet stable, Operator Bakpauu!',
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
