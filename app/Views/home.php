<?= $this->extend('layout/backend') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1 class="cyber-glitch" data-text="Overview Dashboard">Overview Dashboard</h1>
    </div>

    <div class="section-body">
        <!-- Hero Command Center with 3D Hiro Pilot -->
        <div class="card mb-4" style="background: linear-gradient(135deg, rgba(17, 29, 56, 0.95) 0%, rgba(9, 14, 28, 0.98) 100%); border: 1px solid var(--border-tech); box-shadow: var(--neo-shadow);">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-12 mb-4 mb-lg-0">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge badge-primary px-3 py-1" style="font-family: var(--font-mono); font-size: 11px;">
                                <i class="fas fa-satellite-dish mr-1 text-cyan"></i> SYSTEM ONLINE
                            </span>
                            <span class="badge badge-success px-3 py-1" style="font-family: var(--font-mono); font-size: 11px;">
                                <i class="fas fa-check-circle mr-1"></i> VER: 2.3.5
                            </span>
                            <span class="text-muted small font-monospace d-none d-sm-inline">// IPB_VOCATIONAL_STUDIES</span>
                        </div>

                        <h2 class="font-weight-bold text-white mb-1 cyber-glitch" data-text="Accounting Information System • AKN" style="letter-spacing: -0.5px;">
                            Accounting Information System <span style="color: var(--cyan-bright);">&bull; AKN</span>
                        </h2>
                        <h5 class="text-cyan mb-3 font-weight-normal" style="font-family: var(--font-mono); font-size: 15px;">
                            School of Vocational Studies &mdash; IPB University
                        </h5>

                        <p class="text-sub mb-4" style="line-height: 1.6; max-width: 620px;">
                            Integrated web-based accounting information system featuring general ledger, journal entries, 
                            adjusting entries, 10-column worksheet, and automated balanced financial statements.
                        </p>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="<?= site_url('transaksi') ?>" class="btn btn-primary mr-2 mb-2">
                                <i class="fas fa-columns mr-1"></i> Open Transactions
                            </a>
                            <a href="<?= site_url('neracalajur') ?>" class="btn btn-info mr-2 mb-2">
                                <i class="fab fa-gitter mr-1"></i> Worksheet (10-Col)
                            </a>
                            <a href="<?= site_url('labarugi') ?>" class="btn btn-warning mr-2 mb-2">
                                <i class="fas fa-chart-line mr-1"></i> Income Statement
                            </a>
                        </div>
                    </div>

                    <!-- 3D Operator Model Deck (Al.is-a.dev Style Blueprint Portrait) -->
                    <div class="col-lg-5 col-md-12 position-relative">
                        <div class="tech-blueprint-deck" style="background: rgba(10, 16, 32, 0.95); border: 1px solid var(--border-tech); box-shadow: var(--neo-shadow); border-radius: 4px; padding: 18px 20px;">
                            <!-- Deck Header -->
                            <div class="d-flex align-items-center justify-content-between mb-3 pb-2" style="border-bottom: 1px solid var(--border-subtle); font-family: var(--font-mono); font-size: 11px;">
                                <div class="d-flex align-items-center">
                                    <span class="status-indicator mr-2"></span>
                                    <span class="cyber-glitch font-weight-bold" data-text="OPERATOR // BAKPAUU" style="color: var(--cyan-bright); font-size: 13px;">OPERATOR // BAKPAUU</span>
                                </div>
                                <span class="badge badge-primary px-2 py-1" style="font-size: 9.5px; letter-spacing: 1px;">
                                    [PILOT 016]
                                </span>
                            </div>

                            <!-- 3D Canvas Viewport with Corner Brackets -->
                            <div class="tech-viewport-box position-relative" style="width: 100%; height: 320px; background: radial-gradient(circle at 50% 50%, rgba(19, 34, 68, 0.4) 0%, rgba(6, 10, 20, 0.95) 85%); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 4px; overflow: hidden; cursor: grab;">
                                <!-- Technical Corner Brackets -->
                                <span class="tech-corner tech-tl"></span>
                                <span class="tech-corner tech-tr"></span>
                                <span class="tech-corner tech-bl"></span>
                                <span class="tech-corner tech-br"></span>

                                <div id="hiro-hero-canvas-container" style="width: 100%; height: 100%;"></div>

                                <!-- Loading overlay -->
                                <div id="hiro-3d-loading" class="position-absolute" style="inset: 0; display: flex; align-items: center; justify-content: center; background: rgba(5, 8, 17, 0.9); z-index: 5; font-family: var(--font-mono); font-size: 12px; color: var(--cyan-bright);">
                                    <i class="fas fa-atom fa-spin mr-2"></i> Initializing 3D Neural Link...
                                </div>
                            </div>

                            <!-- Deck Footer Bar -->
                            <div class="d-flex align-items-center justify-content-between mt-3 pt-2 text-muted font-monospace" style="border-top: 1px solid var(--border-subtle); font-size: 11px;">
                                <span style="font-size: 11px; color: var(--text-muted);">
                                    <i class="fas fa-arrows-alt text-cyan mr-1"></i> Drag to rotate the model &mdash; if you like.
                                </span>
                                <span class="d-inline-flex align-items-center gap-1 text-cyan font-weight-bold" style="letter-spacing: 1px; font-size: 10px;">
                                    <span class="status-indicator"></span> LIVE RENDER
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metric Stat Cards -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon" style="background: linear-gradient(135deg, #1e3a8a 0%, #0284c7 100%);">
                        <i class="fas fa-wallet text-white"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Account Codes</h4>
                        </div>
                        <div class="card-body font-monospace" style="color: var(--cyan-bright); font-size: 24px; font-weight: 700;">
                            30 <small class="text-muted" style="font-size: 13px;">Accounts</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon" style="background: linear-gradient(135deg, #0284c7 0%, #00b4d8 100%);">
                        <i class="fas fa-file-invoice text-white"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Journal Entries</h4>
                        </div>
                        <div class="card-body font-monospace" style="color: var(--cyan-bright); font-size: 24px; font-weight: 700;">
                            19 <small class="text-muted" style="font-size: 13px;">Dec 2025</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon" style="background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);">
                        <i class="fas fa-sliders-h text-white"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Adjusting Entries</h4>
                        </div>
                        <div class="card-body font-monospace" style="color: #fbbf24; font-size: 24px; font-weight: 700;">
                            5 <small class="text-muted" style="font-size: 13px;">Cases</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                        <i class="fas fa-balance-scale text-white"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Balance Status</h4>
                        </div>
                        <div class="card-body font-monospace" style="color: #34d399; font-size: 20px; font-weight: 700;">
                            BALANCED <i class="fas fa-check-double ml-1" style="font-size: 16px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>