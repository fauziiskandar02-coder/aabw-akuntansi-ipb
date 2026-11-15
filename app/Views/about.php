<?= $this->extend('layout/backend') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="cyber-glitch" data-text="SIA AKN SV-IPB &bull; System Dossier">SIA AKN SV-IPB &bull; System Dossier</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="<?= site_url('/') ?>"><i class="fas fa-home mr-1"></i> Dashboard</a></div>
                <div class="breadcrumb-item active">System Dossier &amp; Academic Credits</div>
            </div>
        </div>
        <div class="d-none d-md-block">
            <span class="tech-tag tech-tag-cyan px-3 py-2">
                <span class="status-indicator mr-2"></span>SYS_ACTIVE // VER: 2.3.8
            </span>
        </div>
    </div>

    <div class="section-body">
        <!-- Hero Dossier Banner -->
        <div class="card mb-4" style="background: linear-gradient(135deg, rgba(14, 25, 48, 0.95) 0%, rgba(7, 12, 24, 0.98) 100%); border: 1px solid var(--border-tech); box-shadow: var(--neo-shadow);">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-12">
                        <div class="d-flex align-items-center gap-2 mb-3 flex-wrap">
                            <span class="text-muted font-monospace small">
                                <i class="fas fa-university mr-1 text-cyan"></i> SCHOOL OF VOCATIONAL STUDIES &mdash; IPB UNIVERSITY
                            </span>
                            <span class="text-muted font-monospace small ml-3">
                                <i class="fas fa-calendar-alt mr-1 text-cyan"></i> PERIOD: DECEMBER 2025
                            </span>
                        </div>

                        <h2 class="font-weight-bold text-white mb-2 cyber-glitch" data-text="PERUSAHAAN AKN-IPB" style="letter-spacing: -0.5px;">
                            SIA AKN SV-IPB &mdash; <span style="color: var(--cyan-bright);">PERUSAHAAN AKN-IPB</span>
                        </h2>

                        <p class="text-sub mb-3" style="line-height: 1.7; max-width: 720px; font-size: 14.5px;">
                            An integrated web-based Accounting Information System designed to automate the complete
                            accounting cycle: from journal entries, general ledger, trial balance, adjusting entries,
                            worksheet, to automated financial reporting (Income Statement, Owner's Equity,
                            Balance Sheet, and Cash Flow Statement).
                        </p>

                        <div class="d-flex flex-wrap gap-2 pt-2">
                            <a href="<?= site_url('jurnalumum') ?>" class="btn btn-primary mr-2 mb-2">
                                <i class="fas fa-book mr-1"></i> General Journal (19 Trx)
                            </a>
                            <a href="<?= site_url('neracalajur') ?>" class="btn btn-info mr-2 mb-2">
                                <i class="fab fa-gitter mr-1"></i> Worksheet
                            </a>
                            <a href="<?= site_url('laporan/neraca') ?>" class="btn btn-warning mr-2 mb-2">
                                <i class="fas fa-balance-scale mr-1"></i> Balance Sheet
                            </a>
                            <a href="<?= site_url('/') ?>" class="btn btn-outline-light mb-2">
                                <i class="fas fa-arrow-left mr-1"></i> Back to Dashboard
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 mt-4 mt-lg-0 text-center">
                        <div class="p-3" style="background: rgba(10, 16, 32, 0.9); border: 1px solid var(--border-tech); border-radius: 6px; box-shadow: var(--neo-shadow-sm);">
                            <div class="mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center" style="width: 76px; height: 76px; border-radius: 50%; background: radial-gradient(circle, rgba(0, 240, 255, 0.25) 0%, rgba(14, 25, 48, 0.9) 70%); border: 2px solid var(--cyan-bright); box-shadow: 0 0 15px rgba(0, 240, 255, 0.4);">
                                    <i class="fas fa-graduation-cap fa-2x" style="color: var(--cyan-bright);"></i>
                                </div>
                            </div>
                            <h5 class="text-white font-weight-bold mb-1">Academic Credentials</h5>
                            <span class="text-muted font-monospace small">DIPLOMA IN ACCOUNTING</span>
                            <div class="text-left font-monospace small mt-3 p-2" style="background: rgba(6, 10, 20, 0.85); border: 1px solid var(--border-subtle); border-radius: 4px;">
                                <div class="text-muted">COURSE: <span class="text-white">Komputer Aplikasi Akuntansi</span></div>
                                <div class="text-muted">INSTITUTE: <span class="text-white">Sekolah Vokasi IPB</span></div>
                                <div class="text-muted">OPERATOR CALL: <span class="text-cyan font-weight-bold">Bakpauu (016)</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Academic Dossier / Student Profile -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card h-100" style="border: 1px solid var(--border-tech); box-shadow: var(--neo-shadow-sm);">
                    <div class="card-header d-flex justify-content-between align-items-center" style="border-bottom: 1px solid var(--border-subtle);">
                        <h4 class="text-white mb-0 font-monospace">
                            <i class="fas fa-id-card mr-2 text-cyan"></i> [DOSSIER // STUDENT PROFILE]
                        </h4>
                        <span class="tech-tag tech-tag-cyan" style="font-size: 11px;">[CLASS: C / P2]</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm font-monospace" style="margin-bottom: 0;">
                                <tbody>
                                    <tr>
                                        <th class="text-cyan" style="width: 38%;"><i class="fas fa-user mr-2"></i>Full Name</th>
                                        <td class="text-white font-weight-bold">Fauzi Iskandar</td>
                                    </tr>
                                    <tr>
                                        <th class="text-cyan"><i class="fas fa-fingerprint mr-2"></i>Student ID</th>
                                        <td class="text-white font-weight-bold" style="color: var(--cyan-bright) !important;">J0414241332</td>
                                    </tr>
                                    <tr>
                                        <th class="text-cyan"><i class="fas fa-users mr-2"></i>Class</th>
                                        <td class="text-white font-weight-bold">C / P2 <span class="text-muted small ml-1">(Mandiri)</span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-cyan"><i class="fas fa-book-reader mr-2"></i>Course</th>
                                        <td class="text-white">Komputer Aplikasi Akuntansi</td>
                                    </tr>
                                    <tr>
                                        <th class="text-cyan"><i class="fas fa-building mr-2"></i>Business Entity</th>
                                        <td class="text-white font-weight-bold">PERUSAHAAN AKN-IPB</td>
                                    </tr>
                                    <tr>
                                        <th class="text-cyan"><i class="fas fa-user-tie mr-2"></i>Business Owner</th>
                                        <td class="text-white">Tuan Najwan</td>
                                    </tr>
                                    <tr>
                                        <th class="text-cyan"><i class="fas fa-clock mr-2"></i>Cycle Period</th>
                                        <td class="text-white">December 31, 2025 (1 Month)</td>
                                    </tr>
                                    <tr>
                                        <th class="text-cyan"><i class="fas fa-gamepad mr-2"></i>System Pilot</th>
                                        <td class="text-white"><span class="text-cyan font-weight-bold font-monospace">Bakpauu // [PILOT 016]</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Financial Engine Verification Benchmarks -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card h-100" style="border: 1px solid var(--border-tech); box-shadow: var(--neo-shadow-sm);">
                    <div class="card-header d-flex justify-content-between align-items-center" style="border-bottom: 1px solid var(--border-subtle);">
                        <h4 class="text-white mb-0 font-monospace">
                            <i class="fas fa-check-double mr-2 text-cyan"></i> [FINANCIAL BENCHMARKS // DEC 2025]
                        </h4>
                        <span class="text-muted font-monospace small"><i class="fas fa-check-circle text-cyan mr-1"></i> ALL OK</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm font-monospace" style="margin-bottom: 0;">
                                <thead>
                                    <tr style="background: rgba(14, 25, 48, 0.8);">
                                        <th class="text-cyan">Metric / Component</th>
                                        <th class="text-right text-cyan">Calculated Value</th>
                                        <th class="text-center text-cyan">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>General Journal (19 Trx)</td>
                                        <td class="text-right text-white font-weight-bold">Rp 155.820.000</td>
                                        <td class="text-center"><span class="text-cyan font-monospace small">&#x2713; OK</span></td>
                                    </tr>
                                    <tr>
                                        <td>Adjusting Entries (5 Adj)</td>
                                        <td class="text-right text-white font-weight-bold">Rp 6.950.000</td>
                                        <td class="text-center"><span class="text-cyan font-monospace small">&#x2713; OK</span></td>
                                    </tr>
                                    <tr>
                                        <td>Trial Balance</td>
                                        <td class="text-right text-white font-weight-bold">Rp 100.700.000</td>
                                        <td class="text-center"><span class="text-cyan font-monospace small">&#x2713; OK</span></td>
                                    </tr>
                                    <tr>
                                        <td>Adjusted Trial Balance</td>
                                        <td class="text-right text-white font-weight-bold">Rp 103.800.000</td>
                                        <td class="text-center"><span class="text-cyan font-monospace small">&#x2713; OK</span></td>
                                    </tr>
                                    <tr>
                                        <td>Net Profit</td>
                                        <td class="text-right font-weight-bold" style="color: #34d399;">Rp 22.930.000</td>
                                        <td class="text-center"><span style="color: #34d399;" class="font-monospace small">&#x2713; SURPLUS</span></td>
                                    </tr>
                                    <tr>
                                        <td>Ending Capital</td>
                                        <td class="text-right text-white font-weight-bold">Rp 89.720.000</td>
                                        <td class="text-center"><span class="text-cyan font-monospace small">&#x2713; OK</span></td>
                                    </tr>
                                    <tr>
                                        <td>Balance Sheet (Assets = Liabilities + Equity)</td>
                                        <td class="text-right text-white font-weight-bold">Rp 94.230.000</td>
                                        <td class="text-center"><span class="text-cyan font-monospace small">&#x2713; OK</span></td>
                                    </tr>
                                    <tr>
                                        <td>Ending Cash Balance</td>
                                        <td class="text-right text-white font-weight-bold" style="color: var(--cyan-bright);">Rp 29.780.000</td>
                                        <td class="text-center"><span class="text-cyan font-monospace small">&#x2713; OK</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Technical Architecture & Features Grid -->
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100" style="border: 1px solid var(--border-tech); box-shadow: var(--neo-shadow-sm);">
                    <div class="card-header">
                        <h5 class="text-white mb-0 font-monospace" style="font-size: 15px;">
                            <i class="fas fa-server mr-2 text-cyan"></i> Backend & Database
                        </h5>
                    </div>
                    <div class="card-body font-monospace" style="font-size: 13px;">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-angle-right text-cyan mr-2"></i><strong>Framework:</strong> CodeIgniter 4.7.4 (PHP 8.2)</li>
                            <li class="mb-2"><i class="fas fa-angle-right text-cyan mr-2"></i><strong>Database:</strong> MySQL InnoDB Relational</li>
                            <li class="mb-2"><i class="fas fa-angle-right text-cyan mr-2"></i><strong>Architecture:</strong> Model-View-Controller (MVC)</li>
                            <li class="mb-2"><i class="fas fa-angle-right text-cyan mr-2"></i><strong>Security:</strong> CSRF Protection, Bcrypt Hashing</li>
                            <li class="mb-0"><i class="fas fa-angle-right text-cyan mr-2"></i><strong>Pipeline:</strong> Automated SQL Batch Migrations &amp; Seeders</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100" style="border: 1px solid var(--border-tech); box-shadow: var(--neo-shadow-sm);">
                    <div class="card-header">
                        <h5 class="text-white mb-0 font-monospace" style="font-size: 15px;">
                            <i class="fas fa-cube mr-2 text-cyan"></i> 3D Pilot & UI Engine
                        </h5>
                    </div>
                    <div class="card-body font-monospace" style="font-size: 13px;">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-angle-right text-cyan mr-2"></i><strong>3D Engine:</strong> WebGL Procedural via Three.js (r128)</li>
                            <li class="mb-2"><i class="fas fa-angle-right text-cyan mr-2"></i><strong>Character:</strong> Chibi Hiro Pilot (Zero-G Floating &amp; Orbit)</li>
                            <li class="mb-2"><i class="fas fa-angle-right text-cyan mr-2"></i><strong>Interaction:</strong> Real-time Head Tracking &amp; 360&deg; Drag</li>
                            <li class="mb-2"><i class="fas fa-angle-right text-cyan mr-2"></i><strong>Dialogue:</strong> English System Status Speech Bubbles</li>
                            <li class="mb-0"><i class="fas fa-angle-right text-cyan mr-2"></i><strong>Theme:</strong> Cyber-Blueprint HUD &amp; CRT Scanline Shader</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 mb-4">
                <div class="card h-100" style="border: 1px solid var(--border-tech); box-shadow: var(--neo-shadow-sm);">
                    <div class="card-header">
                        <h5 class="text-white mb-0 font-monospace" style="font-size: 15px;">
                            <i class="fas fa-layer-group mr-2 text-cyan"></i> Accounting Pipeline
                        </h5>
                    </div>
                    <div class="card-body font-monospace" style="font-size: 13px;">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-angle-right text-cyan mr-2"></i><strong>Chart of Accounts:</strong> 3-Level COA Code Structure</li>
                            <li class="mb-2"><i class="fas fa-angle-right text-cyan mr-2"></i><strong>General Journal:</strong> 19 Balanced Double-Entry Items</li>
                            <li class="mb-2"><i class="fas fa-angle-right text-cyan mr-2"></i><strong>Worksheet:</strong> Auto-Balancing Matrix</li>
                            <li class="mb-2"><i class="fas fa-angle-right text-cyan mr-2"></i><strong>Financial Statements:</strong> Income, Equity, Balance Sheet, Cash Flow</li>
                            <li class="mb-0"><i class="fas fa-angle-right text-cyan mr-2"></i><strong>Reporting:</strong> Instant Date Range Filtering &amp; Clean Print</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Workflow Pipeline Visualizer -->
        <div class="card" style="border: 1px solid var(--border-tech); box-shadow: var(--neo-shadow-sm);">
            <div class="card-header">
                <h4 class="text-white mb-0 font-monospace">
                    <i class="fas fa-project-diagram mr-2 text-cyan"></i> [SYSTEM WORKFLOW // ACCOUNTING CYCLE]
                </h4>
            </div>
            <div class="card-body">
                <div class="row text-center font-monospace">
                    <div class="col-md-2 col-sm-4 col-6 mb-3">
                        <div class="p-3" style="background: rgba(10, 18, 36, 0.7); border: 1px solid var(--border-subtle); border-radius: 4px;">
                            <div class="text-cyan mb-2" style="font-size: 20px;"><i class="fas fa-file-invoice-dollar"></i></div>
                            <div class="text-white font-weight-bold" style="font-size: 12px;">01. TRANSACTIONS</div>
                            <div class="text-muted small">Source Documents</div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 mb-3">
                        <div class="p-3" style="background: rgba(10, 18, 36, 0.7); border: 1px solid var(--border-subtle); border-radius: 4px;">
                            <div class="text-cyan mb-2" style="font-size: 20px;"><i class="fas fa-book"></i></div>
                            <div class="text-white font-weight-bold" style="font-size: 12px;">02. JOURNAL</div>
                            <div class="text-muted small">Debit &amp; Credit</div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 mb-3">
                        <div class="p-3" style="background: rgba(10, 18, 36, 0.7); border: 1px solid var(--border-subtle); border-radius: 4px;">
                            <div class="text-cyan mb-2" style="font-size: 20px;"><i class="fas fa-book-open"></i></div>
                            <div class="text-white font-weight-bold" style="font-size: 12px;">03. LEDGER</div>
                            <div class="text-muted small">General Ledger</div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 mb-3">
                        <div class="p-3" style="background: rgba(10, 18, 36, 0.7); border: 1px solid var(--border-subtle); border-radius: 4px;">
                            <div class="text-cyan mb-2" style="font-size: 20px;"><i class="fas fa-sliders-h"></i></div>
                            <div class="text-white font-weight-bold" style="font-size: 12px;">04. ADJUSTMENTS</div>
                            <div class="text-muted small">5 Adjusting Entries</div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 mb-3">
                        <div class="p-3" style="background: rgba(10, 18, 36, 0.7); border: 1px solid var(--border-subtle); border-radius: 4px;">
                            <div class="text-cyan mb-2" style="font-size: 20px;"><i class="fab fa-gitter"></i></div>
                            <div class="text-white font-weight-bold" style="font-size: 12px;">05. WORKSHEET</div>
                            <div class="text-muted small">TB, Adj &amp; FS</div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6 mb-3">
                        <div class="p-3" style="background: rgba(10, 18, 36, 0.7); border: 1px solid var(--border-subtle); border-radius: 4px;">
                            <div class="text-cyan mb-2" style="font-size: 20px;"><i class="fas fa-chart-line"></i></div>
                            <div class="text-white font-weight-bold" style="font-size: 12px;">06. REPORTS</div>
                            <div class="text-muted small">4 Financial Statements</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?= $this->endSection() ?>
