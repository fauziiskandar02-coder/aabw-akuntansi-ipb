/**
 * AABW Cyber Diamond-Shutter Page Transition
 * Exact Recreation of the 45-Degree Diamond Grid Shutter from https://al.is-a.dev
 */

(function () {
  'use strict';

  // Create Diamond Shutter DOM
  const overlay = document.createElement('div');
  overlay.id = 'cyber-shutter-overlay';
  overlay.style.cssText = `
    position: fixed;
    inset: 0;
    z-index: 99999;
    pointer-events: none;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: opacity 0.4s ease;
  `;

  const gridContainer = document.createElement('div');
  gridContainer.style.cssText = `
    width: 160vmax;
    height: 160vmax;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(45deg);
    display: grid;
    grid-template-columns: repeat(10, 1fr);
    grid-template-rows: repeat(10, 1fr);
  `;

  // Create 100 diamond cells
  const cells = [];
  for (let i = 0; i < 100; i++) {
    const cell = document.createElement('div');
    cell.style.cssText = `
      background: #070b14;
      border: 1px solid rgba(56, 189, 248, 0.2);
      transform-origin: center;
      transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.35s ease;
    `;
    gridContainer.appendChild(cell);
    cells.push(cell);
  }

  overlay.appendChild(gridContainer);
  document.body.appendChild(overlay);

  // --- REVEAL WAVE ON PAGE LOAD ---
  function revealShutter() {
    cells.forEach((cell, idx) => {
      // Calculate diagonal distance from center
      const row = Math.floor(idx / 10);
      const col = idx % 10;
      const dist = Math.sqrt(Math.pow(row - 4.5, 2) + Math.pow(col - 4.5, 2));
      const delay = dist * 35; // Staggered diagonal wave

      setTimeout(() => {
        cell.style.transform = 'scale(0)';
        cell.style.opacity = '0';
      }, delay);
    });

    // Remove overlay pointer blocking
    setTimeout(() => {
      overlay.style.display = 'none';
    }, 700);
  }

  // --- CLOSE SHUTTER BEFORE NAVIGATION ---
  function closeShutter(targetUrl) {
    overlay.style.display = 'flex';
    overlay.style.pointerEvents = 'auto';

    cells.forEach((cell, idx) => {
      const row = Math.floor(idx / 10);
      const col = idx % 10;
      const dist = Math.sqrt(Math.pow(row - 4.5, 2) + Math.pow(col - 4.5, 2));
      const delay = dist * 25;

      setTimeout(() => {
        cell.style.transform = 'scale(1)';
        cell.style.opacity = '1';
      }, delay);
    });

    setTimeout(() => {
      window.location.href = targetUrl;
    }, 420);
  }

  // Listen to internal link clicks for smooth cyber transitions
  document.addEventListener('DOMContentLoaded', () => {
    // Initial page open reveal
    revealShutter();

    // Hook internal links
    const links = document.querySelectorAll('a[href^="http://localhost:8080"], a[href^="/"], a[href^="' + window.location.origin + '"]');
    links.forEach(a => {
      if (!href || href.startsWith('#') || a.target === '_blank' || a.classList.contains('no-transition') || href.includes('/cetak') || a.hasAttribute('data-confirm') || a.hasAttribute('data-toggle')) {
        return;
      }

      a.addEventListener('click', (e) => {
        if (e.metaKey || e.ctrlKey || e.shiftKey) return;
        e.preventDefault();
        closeShutter(href);
      });
    });
  });
})();
