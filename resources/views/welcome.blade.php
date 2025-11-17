<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Pitstop by Pertamina</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Questrial:wght@400&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Landing Page Web Pitstop by Pertamina
  * by Randy Dwi Saputra - +62856440997
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

<a href="" class="logo d-flex align-items-center">
  <img src="images/logo.png" alt="Pitstop by Pertamina">
  {{-- <h1 class="sitename ms-2">Pitstop by Pertamina</h1> --}}
</a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
                    <li class="dropdown extended-dropdown-2"><a href="#"><span>Dashboard</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li>
                <a href="/dashboard/login">
                  <div class="menu-item-content">
                    <div class="menu-icon">
                      <i class="bi bi-speedometer2"></i>
                    </div>
                    <div class="menu-text">
                      <span class="menu-title">Analytics Dashboard</span>
                      <span class="menu-description">Pantau data produk dan pengajuan produkmu !</span>
                    </div>
                  </div>
                  <div class="menu-badge">New</div>
                </a>
              </li>
              <li>
                <a href="/dashboard/login">
                  <div class="menu-item-content">
                    <div class="menu-icon">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="menu-text">
                      <span class="menu-title">Team Management</span>
                      <span class="menu-description">Terhubung langsung dengan petugas</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="/dashboard/login">
                  <div class="menu-item-content">
                    <div class="menu-icon">
                      <i class="bi bi-graph-up"></i>
                    </div>
                    <div class="menu-text">
                      <span class="menu-title">Sales Reports</span>
                      <span class="menu-description">Data Penjualan akan dapat diliihat oleh mitra</span>
                    </div>
                  </div>
                  <div class="menu-badge hot">Soon</div>
                </a>
              </li>
              <li>
                <a href="/dashboard/profile">
                  <div class="menu-item-content">
                    <div class="menu-icon">
                      <i class="bi bi-shield-lock"></i>
                    </div>
                    <div class="menu-text">
                      <span class="menu-title">Security Center</span>
                      <span class="menu-description">Manajemen privasi yang aman</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="/dashboard/login">
                  <div class="menu-item-content">
                    <div class="menu-icon">
                      <i class="bi bi-chat-dots"></i>
                    </div>
                    <div class="menu-text">
                      <span class="menu-title">Message Center</span>
                      <span class="menu-description">Pesan Notifikasi real-time</span>
                    </div>
                  </div>
                  <div class="menu-badge hot">Soon</div>
                </a>
              </li>
            </ul>
          </li>
          <li><a href="#about">About</a></li>
          <li><a href="#features">Fitur</a></li>
          <li><a href="#tabs">Alur Pendaftaran</a></li>
          <li><a href="#testimonials">Testimoni</a></li>
          {{-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li> --}}

          <!-- Megamenu 2 -->
          {{-- <li class="megamenu-2"><a href="#"><span>Megamenu</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>

            <!-- Mobile Megamenu -->
            <ul class="mobile-megamenu">

              <li><a href="#">Product Analytics</a></li>
              <li><a href="#">Customer Insights</a></li>
              <li><a href="#">Market Research</a></li>

              <li class="dropdown"><a href="#"><span>Enterprise Software</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">CRM Solutions</a></li>
                  <li><a href="#">ERP Systems</a></li>
                  <li><a href="#">Workflow Automation</a></li>
                  <li><a href="#">Document Management</a></li>
                  <li><a href="#">Business Intelligence</a></li>
                  <li><a href="#">Integration Platform</a></li>
                </ul>
              </li>

              <li class="dropdown"><a href="#"><span>Development Tools</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Code Editors</a></li>
                  <li><a href="#">Version Control</a></li>
                  <li><a href="#">Testing Frameworks</a></li>
                  <li><a href="#">Deployment Tools</a></li>
                  <li><a href="#">API Management</a></li>
                  <li><a href="#">Performance Monitoring</a></li>
                </ul>
              </li>

              <li class="dropdown"><a href="#"><span>Creative Suite</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Design Software</a></li>
                  <li><a href="#">Video Editing</a></li>
                  <li><a href="#">Audio Production</a></li>
                  <li><a href="#">Animation Tools</a></li>
                  <li><a href="#">Photo Editing</a></li>
                  <li><a href="#">3D Modeling</a></li>
                </ul>
              </li>

              <li class="dropdown"><a href="#"><span>Resources</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Documentation</a></li>
                  <li><a href="#">Tutorials</a></li>
                  <li><a href="#">Community</a></li>
                  <li><a href="#">Blog Posts</a></li>
                </ul>
              </li>

            </ul><!-- End Mobile Megamenu -->

            <!-- Desktop Megamenu -->
            <div class="desktop-megamenu">

              <div class="tab-navigation">
                <ul class="nav nav-tabs flex-column" id="7525-megamenu-tabs" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="7525-tab-1-tab" data-bs-toggle="tab" data-bs-target="#7525-tab-1" type="button" role="tab" aria-controls="7525-tab-1" aria-selected="true">
                      <i class="bi bi-building-gear"></i>
                      <span>Enterprise Software</span>
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="7525-tab-2-tab" data-bs-toggle="tab" data-bs-target="#7525-tab-2" type="button" role="tab" aria-controls="7525-tab-2" aria-selected="false">
                      <i class="bi bi-code-slash"></i>
                      <span>Development Tools</span>
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="7525-tab-3-tab" data-bs-toggle="tab" data-bs-target="#7525-tab-3" type="button" role="tab" aria-controls="7525-tab-3" aria-selected="false">
                      <i class="bi bi-palette"></i>
                      <span>Creative Suite</span>
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="7525-tab-4-tab" data-bs-toggle="tab" data-bs-target="#7525-tab-4" type="button" role="tab" aria-controls="7525-tab-4" aria-selected="false">
                      <i class="bi bi-journal-text"></i>
                      <span>Resources</span>
                    </button>
                  </li>
                </ul>
              </div>

              <div class="tab-content">

                <!-- Enterprise Software Tab -->
                <div class="tab-pane fade show active" id="7525-tab-1" role="tabpanel" aria-labelledby="7525-tab-1-tab">
                  <div class="content-grid">
                    <div class="product-section">
                      <h4>Core Solutions</h4>
                      <div class="product-list">
                        <a href="#" class="product-link">
                          <i class="bi bi-people"></i>
                          <div>
                            <span>CRM Solutions</span>
                            <small>Manage customer relationships effectively</small>
                          </div>
                        </a>
                        <a href="#" class="product-link">
                          <i class="bi bi-diagram-3"></i>
                          <div>
                            <span>ERP Systems</span>
                            <small>Integrate all business processes</small>
                          </div>
                        </a>
                        <a href="#" class="product-link">
                          <i class="bi bi-gear-wide"></i>
                          <div>
                            <span>Workflow Automation</span>
                            <small>Streamline repetitive tasks</small>
                          </div>
                        </a>
                      </div>
                    </div>

                    <div class="product-section">
                      <h4>Data &amp; Analytics</h4>
                      <div class="product-list">
                        <a href="#" class="product-link">
                          <i class="bi bi-file-earmark-text"></i>
                          <div>
                            <span>Document Management</span>
                            <small>Organize and secure documents</small>
                          </div>
                        </a>
                        <a href="#" class="product-link">
                          <i class="bi bi-bar-chart"></i>
                          <div>
                            <span>Business Intelligence</span>
                            <small>Make data-driven decisions</small>
                          </div>
                        </a>
                        <a href="#" class="product-link">
                          <i class="bi bi-share"></i>
                          <div>
                            <span>Integration Platform</span>
                            <small>Connect all your systems</small>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>

                  <div class="featured-banner">
                    <div class="banner-content">
                      <img src="assets/img/misc/misc-7.webp" alt="Enterprise Solutions" class="banner-image">
                      <div class="banner-info">
                        <h5>Enterprise Package</h5>
                        <p>Comprehensive business management solution with advanced features and 24/7 support.</p>
                        <a href="#" class="cta-btn">Get Started <i class="bi bi-arrow-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Development Tools Tab -->
                <div class="tab-pane fade" id="7525-tab-2" role="tabpanel" aria-labelledby="7525-tab-2-tab">
                  <div class="content-grid">
                    <div class="product-section">
                      <h4>Code &amp; Build</h4>
                      <div class="product-list">
                        <a href="#" class="product-link">
                          <i class="bi bi-code-square"></i>
                          <div>
                            <span>Code Editors</span>
                            <small>Advanced development environment</small>
                          </div>
                        </a>
                        <a href="#" class="product-link">
                          <i class="bi bi-git"></i>
                          <div>
                            <span>Version Control</span>
                            <small>Track changes and collaborate</small>
                          </div>
                        </a>
                        <a href="#" class="product-link">
                          <i class="bi bi-check2-square"></i>
                          <div>
                            <span>Testing Frameworks</span>
                            <small>Ensure code quality</small>
                          </div>
                        </a>
                      </div>
                    </div>

                    <div class="product-section">
                      <h4>Deploy &amp; Monitor</h4>
                      <div class="product-list">
                        <a href="#" class="product-link">
                          <i class="bi bi-cloud-upload"></i>
                          <div>
                            <span>Deployment Tools</span>
                            <small>Seamless application deployment</small>
                          </div>
                        </a>
                        <a href="#" class="product-link">
                          <i class="bi bi-api"></i>
                          <div>
                            <span>API Management</span>
                            <small>Design and manage APIs</small>
                          </div>
                        </a>
                        <a href="#" class="product-link">
                          <i class="bi bi-speedometer2"></i>
                          <div>
                            <span>Performance Monitoring</span>
                            <small>Track application performance</small>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>

                  <div class="featured-banner">
                    <div class="banner-content">
                      <img src="assets/img/misc/misc-12.webp" alt="Development Tools" class="banner-image">
                      <div class="banner-info">
                        <h5>Developer Suite</h5>
                        <p>Complete toolkit for modern development teams with integrated CI/CD pipelines.</p>
                        <a href="#" class="cta-btn">Explore Tools <i class="bi bi-arrow-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Creative Suite Tab -->
                <div class="tab-pane fade" id="7525-tab-3" role="tabpanel" aria-labelledby="7525-tab-3-tab">
                  <div class="content-grid">
                    <div class="product-section">
                      <h4>Design &amp; Visual</h4>
                      <div class="product-list">
                        <a href="#" class="product-link">
                          <i class="bi bi-brush"></i>
                          <div>
                            <span>Design Software</span>
                            <small>Professional graphic design tools</small>
                          </div>
                        </a>
                        <a href="#" class="product-link">
                          <i class="bi bi-camera-video"></i>
                          <div>
                            <span>Video Editing</span>
                            <small>Professional video production</small>
                          </div>
                        </a>
                        <a href="#" class="product-link">
                          <i class="bi bi-image"></i>
                          <div>
                            <span>Photo Editing</span>
                            <small>Advanced image manipulation</small>
                          </div>
                        </a>
                      </div>
                    </div>

                    <div class="product-section">
                      <h4>Media Production</h4>
                      <div class="product-list">
                        <a href="#" class="product-link">
                          <i class="bi bi-music-note"></i>
                          <div>
                            <span>Audio Production</span>
                            <small>Professional audio editing</small>
                          </div>
                        </a>
                        <a href="#" class="product-link">
                          <i class="bi bi-play-circle"></i>
                          <div>
                            <span>Animation Tools</span>
                            <small>Create stunning animations</small>
                          </div>
                        </a>
                        <a href="#" class="product-link">
                          <i class="bi bi-box"></i>
                          <div>
                            <span>3D Modeling</span>
                            <small>Advanced 3D design software</small>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>

                  <div class="featured-banner">
                    <div class="banner-content">
                      <img src="assets/img/misc/misc-5.webp" alt="Creative Suite" class="banner-image">
                      <div class="banner-info">
                        <h5>Creative Pro</h5>
                        <p>Everything you need for creative projects, from concept to final production.</p>
                        <a href="#" class="cta-btn">Start Creating <i class="bi bi-arrow-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Resources Tab -->
                <div class="tab-pane fade" id="7525-tab-4" role="tabpanel" aria-labelledby="7525-tab-4-tab">
                  <div class="resources-layout">
                    <div class="resource-categories">
                      <div class="resource-category">
                        <i class="bi bi-book"></i>
                        <h5>Documentation</h5>
                        <p>Comprehensive guides and API references for all our products and services.</p>
                        <a href="#" class="resource-link">Browse Docs <i class="bi bi-arrow-right"></i></a>
                      </div>
                      <div class="resource-category">
                        <i class="bi bi-play-circle"></i>
                        <h5>Video Tutorials</h5>
                        <p>Step-by-step video guides to help you get the most out of our solutions.</p>
                        <a href="#" class="resource-link">Watch Tutorials <i class="bi bi-arrow-right"></i></a>
                      </div>
                      <div class="resource-category">
                        <i class="bi bi-chat-square-dots"></i>
                        <h5>Community Forum</h5>
                        <p>Connect with other users, share tips, and get answers to your questions.</p>
                        <a href="#" class="resource-link">Join Community <i class="bi bi-arrow-right"></i></a>
                      </div>
                      <div class="resource-category">
                        <i class="bi bi-newspaper"></i>
                        <h5>Blog &amp; Articles</h5>
                        <p>Latest insights, best practices, and industry trends from our experts.</p>
                        <a href="#" class="resource-link">Read Blog <i class="bi bi-arrow-right"></i></a>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

            </div><!-- End Desktop Megamenu -->

          </li><!-- End Mega Menu 2 --> --}}

          {{-- <li><a href="#contact">Contact</a></li> --}}

        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="hero-content">
              <h1>Kuatkan <span>UMKM Kuliner</span></h1>
              <p>Permudah operasional, perluas jangkauan, dan percepat omzet dengan alat yang ramah UMKM.</p>
              <div class="hero-actions justify-content-center justify-content-lg-start">
                <a href="/dashboard/login" class="btn-primary scrollto">Masuk</a>
                <a href="/dashboard/register" class="btn-primary scrollto">Daftar</a>
                {{-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-video d-flex align-items-center">
                  <i class="bi bi-play-fill"></i>
                  <span>Watch Demo</span>
                </a> --}}
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="hero-image">
              <img src="assets/img/illustration/illustration-29.png" class="img-fluid floating" alt="Pitstop by Pertamina">
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section">

      <div class="container">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="assets/img/clients/clients-1.jpg" class="img-fluid" alt="Pitstop by Pertamina"></div>
            <div class="swiper-slide"><img src="assets/img/clients/clients-1.jpg" class="img-fluid" alt="Pitstop by Pertamina"></div>
            <div class="swiper-slide"><img src="assets/img/clients/clients-1.jpg" class="img-fluid" alt="Pitstop by Pertamina"></div>
            <div class="swiper-slide"><img src="assets/img/clients/clients-1.jpg" class="img-fluid" alt="Pitstop by Pertamina"></div>
            <div class="swiper-slide"><img src="assets/img/clients/clients-1.jpg" class="img-fluid" alt="Pitstop by Pertamina"></div>
            <div class="swiper-slide"><img src="assets/img/clients/clients-1.jpg" class="img-fluid" alt="Pitstop by Pertamina"></div>
            <div class="swiper-slide"><img src="assets/img/clients/clients-1.jpg" class="img-fluid" alt="Pitstop by Pertamina"></div>
            <div class="swiper-slide"><img src="assets/img/clients/clients-1.jpg" class="img-fluid" alt="Pitstop by Pertamina"></div>
          </div>
        </div>

      </div>

    </section><!-- /Clients Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row align-items-center">

          <!-- Image Column -->
          <div class="col-lg-6">
            <div class="about-image">
              <img src="assets/img/about/Patra-UMKM-Batu.jpg" alt="Pitstop by Pertamina" class="img-fluid">
            </div>
          </div>

          <!-- Content Column -->
          <div class="col-lg-6">
            <div class="content">
              <h2>Pitstop by Pertamina</h2>
              <p class="lead">Kami membangun Pitstop sebagai jembatan antara UMKM kuliner dan SPBU, memungkinkan pelaku usaha menjual produk tanpa sewa tempat, dengan sistem yang data driven, transparan, dan mudah digunakan. Inovasi kami berfokus pada pengalaman mitra yang mulus: dari pendaftaran, kurasi produk, hingga penempatan di SPBU.</p>

              <p>Di balik teknologi, ada dedikasi tim lapangan (Pitstoper) yang memastikan kualitas, ketersediaan produk, dan kepuasan pelanggan tetap terjaga. Kami percaya pertumbuhan UMKM berawal dari akses pasar yang adil dan operasi yang efisien—itulah yang kami wujudkan setiap hari.</p>

              <!-- Stats Row -->
              <div class="stats-row">
                <div class="stat-item">
                  <h3><span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1" class="purecounter"></span>+</h3>
                  <p>SPBU Terdaftar</p>
                </div>
                <div class="stat-item">
                  <h3><span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1" class="purecounter"></span>+</h3>
                  <p>Mitra Terdaftar</p>
                </div>
                <div class="stat-item">
                  <h3><span data-purecounter-start="0" data-purecounter-end="98" data-purecounter-duration="1" class="purecounter"></span>%</h3>
                  <p>Mitra Puas</p>
                </div>
              </div><!-- End Stats Row -->

              <!-- CTA Button -->
              <div class="cta-wrapper">
                <a href="/dashboard/login" class="btn-cta">
                  <span>Daftarkan UMKM anda!</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>

            </div>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Services Section -->
    {{-- <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title">
        <h2>Services</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6">
            <div class="service-card">
              <div class="service-icon">
                <i class="bi bi-palette"></i>
              </div>
              <h3>Creative Design</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore.</p>
              <a href="service-details.html" class="service-link">
                Learn More
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div><!-- End Service Card -->

          <div class="col-lg-4 col-md-6">
            <div class="service-card">
              <div class="service-icon">
                <i class="bi bi-code-slash"></i>
              </div>
              <h3>Web Development</h3>
              <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.</p>
              <a href="service-details.html" class="service-link">
                Learn More
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div><!-- End Service Card -->

          <div class="col-lg-4 col-md-6">
            <div class="service-card">
              <div class="service-icon">
                <i class="bi bi-megaphone"></i>
              </div>
              <h3>Digital Marketing</h3>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
              <a href="service-details.html" class="service-link">
                Learn More
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div><!-- End Service Card -->

          <div class="col-lg-4 col-md-6">
            <div class="service-card">
              <div class="service-icon">
                <i class="bi bi-graph-up-arrow"></i>
              </div>
              <h3>Business Strategy</h3>
              <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.</p>
              <a href="service-details.html" class="service-link">
                Learn More
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div><!-- End Service Card -->

          <div class="col-lg-4 col-md-6">
            <div class="service-card">
              <div class="service-icon">
                <i class="bi bi-shield-check"></i>
              </div>
              <h3>Security Solutions</h3>
              <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
              <a href="service-details.html" class="service-link">
                Learn More
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div><!-- End Service Card -->

          <div class="col-lg-4 col-md-6">
            <div class="service-card">
              <div class="service-icon">
                <i class="bi bi-headset"></i>
              </div>
              <h3>24/7 Support</h3>
              <p>Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae.</p>
              <a href="service-details.html" class="service-link">
                Learn More
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div><!-- End Service Card -->

        </div>

      </div>

    </section><!-- /Services Section --> --}}

    <!-- Features Section -->
    <section id="features" class="features section">

      <div class="container">

        <div class="features-grid">
          <div class="features-card">
            <div class="icon-wrapper">
              <i class="bi bi-laptop"></i>
            </div>
            <h3>Onboarding UMKM Tanpa Ribet</h3>
            <p>
              Buka akses pasar di area SPBU dalam hitungan menit—daftar, unggah produk, ajukan lokasi.
            </p>
            <div class="features-list">
              <div class="feature-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Form sederhana & verifikasi cepat</span>
              </div>
              <div class="feature-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Panduan foto/label pangan</span>
              </div>
              <div class="feature-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Tracking status pengajuan real-time</span>
              </div>
            </div>
            <div class="image-container">
              <img src="assets/img/illustration/illustration-14.webp" alt="Pitstop by Pertamina" class="img-fluid">
            </div>
          </div>

          <div class="features-card">
            <div class="icon-wrapper">
              <i class="bi bi-graph-up"></i>
            </div>
            <h3>Data Realtime</h3>
            <p>
             Lihat ringkasan performa pendaftaran dalam sekali klik dari jumlah pengajuan hingga status terbaru. Data disajikan sederhana agar Anda cepat menangkap tren dan mengambil langkah berikutnya.
            </p>
            <div class="features-list">
              <div class="feature-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Cek Status Pengajuan</span>
              </div>
              <div class="feature-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Notifikasi</span>
              </div>
              <div class="feature-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Pemantauan Proses Pengajuan</span>
              </div>
            </div>
            <div class="image-container">
              <img src="assets/img/illustration/illustration-6.webp" alt="Pitstop by Pertamina" class="img-fluid">
            </div>
          </div>

          <div class="features-card">
            <div class="icon-wrapper">
              <i class="bi bi-shield-lock"></i>
            </div>
            <h3>Sistem Keamanan Data</h3>
            <p>
              Keamanan data Anda adalah prioritas utama kami. Seluruh proses pendaftaran dilindungi dengan sistem keamanan berlapis agar setiap informasi tetap aman dan hanya diakses oleh pihak yang berwenang.
            </p>
            <div class="features-list">
              <div class="feature-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Pemindaian Keamanan</span>
              </div>
              <div class="feature-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Enkripsi End to End</span>
              </div>
              <div class="feature-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Validasi Otomatis</span>
              </div>
            </div>
            <div class="image-container">
              <img src="assets/img/illustration/illustration-7.webp" alt="Pitstop by Pertamina" class="img-fluid">
            </div>
          </div>

          <div class="features-card">
            <div class="icon-wrapper">
              <i class="bi bi-people"></i>
            </div>
            <h3>Komunikasi dengan Admin</h3>
            <p>
              Setiap proses pendaftaran tidak berhenti setelah formulir dikirim. Melalui fitur komunikasi langsung, Anda dapat berinteraksi dengan admin untuk memastikan semua data dan dokumen berjalan sesuai prosedur
            </p>
            <div class="features-list">
              <div class="feature-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Respons Cepat dengan Admin</span>
              </div>
              <div class="feature-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Riwayat Permintaan</span>
              </div>
              <div class="feature-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Pemberitahuan Cepat</span>
              </div>
            </div>
            <div class="image-container">
              <img src="assets/img/illustration/illustration-8.webp" alt="Pitstop by Pertamina" class="img-fluid">
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Features Section -->

    <!-- Portfolio Section -->
    {{-- <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title">
        <h2>Portfolio</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="fitRows" data-sort="original-order">

          <div class="portfolio-filters-wrapper">
            <ul class="portfolio-filters isotope-filters">
              <li data-filter="*" class="filter-active">All Projects</li>
              <li data-filter=".filter-branding">Branding</li>
              <li data-filter=".filter-web">Web Design</li>
              <li data-filter=".filter-print">Print Design</li>
              <li data-filter=".filter-motion">Motion</li>
            </ul>
          </div>

          <div class="row gy-4 portfolio-grid isotope-container">

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <div class="portfolio-card">
                <div class="image-container">
                  <img src="assets/img/portfolio/portfolio-3.webp" class="img-fluid" alt="Brand Identity" loading="lazy">
                  <div class="overlay">
                    <div class="overlay-content">
                      <a href="assets/img/portfolio/portfolio-3.webp" class="glightbox zoom-link" title="Brand Identity Project">
                        <i class="bi bi-zoom-in"></i>
                      </a>
                      <a href="portfolio-details.html" class="details-link" title="View Project Details">
                        <i class="bi bi-arrow-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="content">
                  <h3>Brand Identity</h3>
                  <p>Corporate branding and visual identity system</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-web">
              <div class="portfolio-card">
                <div class="image-container">
                  <img src="assets/img/portfolio/portfolio-7.webp" class="img-fluid" alt="E-commerce Platform" loading="lazy">
                  <div class="overlay">
                    <div class="overlay-content">
                      <a href="assets/img/portfolio/portfolio-7.webp" class="glightbox zoom-link" title="E-commerce Platform">
                        <i class="bi bi-zoom-in"></i>
                      </a>
                      <a href="portfolio-details.html" class="details-link" title="View Project Details">
                        <i class="bi bi-arrow-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="content">
                  <h3>E-commerce Platform</h3>
                  <p>Modern online shopping experience</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-print">
              <div class="portfolio-card">
                <div class="image-container">
                  <img src="assets/img/portfolio/portfolio-portrait-5.webp" class="img-fluid" alt="Magazine Design" loading="lazy">
                  <div class="overlay">
                    <div class="overlay-content">
                      <a href="assets/img/portfolio/portfolio-portrait-5.webp" class="glightbox zoom-link" title="Magazine Design">
                        <i class="bi bi-zoom-in"></i>
                      </a>
                      <a href="portfolio-details.html" class="details-link" title="View Project Details">
                        <i class="bi bi-arrow-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="content">
                  <h3>Magazine Design</h3>
                  <p>Editorial layout and typography</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-motion">
              <div class="portfolio-card">
                <div class="image-container">
                  <img src="assets/img/portfolio/portfolio-8.webp" class="img-fluid" alt="Motion Graphics" loading="lazy">
                  <div class="overlay">
                    <div class="overlay-content">
                      <a href="assets/img/portfolio/portfolio-8.webp" class="glightbox zoom-link" title="Motion Graphics">
                        <i class="bi bi-zoom-in"></i>
                      </a>
                      <a href="portfolio-details.html" class="details-link" title="View Project Details">
                        <i class="bi bi-arrow-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="content">
                  <h3>Motion Graphics</h3>
                  <p>Animated visual storytelling</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <div class="portfolio-card">
                <div class="image-container">
                  <img src="assets/img/portfolio/portfolio-9.webp" class="img-fluid" alt="Logo Collection" loading="lazy">
                  <div class="overlay">
                    <div class="overlay-content">
                      <a href="assets/img/portfolio/portfolio-9.webp" class="glightbox zoom-link" title="Logo Collection">
                        <i class="bi bi-zoom-in"></i>
                      </a>
                      <a href="portfolio-details.html" class="details-link" title="View Project Details">
                        <i class="bi bi-arrow-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="content">
                  <h3>Logo Collection</h3>
                  <p>Diverse brand mark explorations</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-web">
              <div class="portfolio-card">
                <div class="image-container">
                  <img src="assets/img/portfolio/portfolio-portrait-8.webp" class="img-fluid" alt="Mobile App Design" loading="lazy">
                  <div class="overlay">
                    <div class="overlay-content">
                      <a href="assets/img/portfolio/portfolio-portrait-8.webp" class="glightbox zoom-link" title="Mobile App Design">
                        <i class="bi bi-zoom-in"></i>
                      </a>
                      <a href="portfolio-details.html" class="details-link" title="View Project Details">
                        <i class="bi bi-arrow-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="content">
                  <h3>Mobile App Design</h3>
                  <p>User-centered interface design</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-print">
              <div class="portfolio-card">
                <div class="image-container">
                  <img src="assets/img/portfolio/portfolio-10.webp" class="img-fluid" alt="Packaging Design" loading="lazy">
                  <div class="overlay">
                    <div class="overlay-content">
                      <a href="assets/img/portfolio/portfolio-10.webp" class="glightbox zoom-link" title="Packaging Design">
                        <i class="bi bi-zoom-in"></i>
                      </a>
                      <a href="portfolio-details.html" class="details-link" title="View Project Details">
                        <i class="bi bi-arrow-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="content">
                  <h3>Packaging Design</h3>
                  <p>Sustainable product packaging solutions</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-motion">
              <div class="portfolio-card">
                <div class="image-container">
                  <img src="assets/img/portfolio/portfolio-11.webp" class="img-fluid" alt="Brand Animation" loading="lazy">
                  <div class="overlay">
                    <div class="overlay-content">
                      <a href="assets/img/portfolio/portfolio-11.webp" class="glightbox zoom-link" title="Brand Animation">
                        <i class="bi bi-zoom-in"></i>
                      </a>
                      <a href="portfolio-details.html" class="details-link" title="View Project Details">
                        <i class="bi bi-arrow-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="content">
                  <h3>Brand Animation</h3>
                  <p>Dynamic brand identity systems</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

          </div><!-- End Portfolio Grid -->

        </div>

      </div>

    </section><!-- /Portfolio Section --> --}}

    {{-- <!-- How We Work Section -->
    <section id="how-we-work" class="how-we-work section">

      <!-- Section Title -->
      <div class="container section-title">
        <h2>How We Work</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="steps-wrapper">

          <div class="row">
            <div class="col-lg-3 col-md-6">
              <div class="step-item">
                <div class="step-circle">
                  <span>1</span>
                </div>
                <h3>Discovery</h3>
                <p>Understanding your business goals and requirements through in-depth analysis and consultation sessions.</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="step-item">
                <div class="step-circle">
                  <span>2</span>
                </div>
                <h3>Planning</h3>
                <p>Creating detailed project roadmaps and strategies aligned with your objectives and timeline requirements.</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="step-item">
                <div class="step-circle">
                  <span>3</span>
                </div>
                <h3>Execution</h3>
                <p>Implementing solutions with precision while maintaining transparent communication throughout the process.</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="step-item">
                <div class="step-circle">
                  <span>4</span>
                </div>
                <h3>Delivery</h3>
                <p>Finalizing implementations and providing comprehensive support to ensure long-term success.</p>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /How We Work Section --> --}}

    <!-- Tabs Section -->
    <section id="tabs" class="tabs section">

      <div class="container">

        <div class="tabs-wrapper">
          <div class="tabs-header">
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tabs-tab-1">
                  <div class="tab-content-preview">
                    <span class="tab-number">01</span>
                    <div class="tab-text">
                      <h6>Daftar</h6>
                      <small>Buat Akun Mitra</small>
                    </div>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tabs-tab-2">
                  <div class="tab-content-preview">
                    <span class="tab-number">02</span>
                    <div class="tab-text">
                      <h6>Produk</h6>
                      <small>Masukkan data produk anda</small>
                    </div>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tabs-tab-3">
                  <div class="tab-content-preview">
                    <span class="tab-number">03</span>
                    <div class="tab-text">
                      <h6>SPBU</h6>
                      <small>Ajukan ke SPBU yang tersedia</small>
                    </div>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tabs-tab-4">
                  <div class="tab-content-preview">
                    <span class="tab-number">04</span>
                    <div class="tab-text">
                      <h6>Hubungi</h6>
                      <small>Tim Pitstop akan menghubungi anda</small>
                    </div>
                  </div>
                </a>
              </li>
            </ul>
          </div>

          <div class="tab-content">

            <div class="tab-pane fade active show" id="tabs-tab-1">
              <div class="row align-items-center">
                <div class="col-lg-6">
                  <div class="content-area">
                    <div class="content-badge">
                      <i class="bi bi-person-add"></i>
                      <span>Buat Akun</span>
                    </div>
                    <h3>Daftar Akun Mitra</h3>
                    <p>Langkah pertama, buat akun mitra terlebih dahulu agar Anda bisa mengakses seluruh fitur di website ini. Isi data diri dengan lengkap seperti nama, alamat email, dan nomor telepon yang aktif. Proses pembuatan akun ini hanya memerlukan beberapa menit saja dan menjadi syarat utama sebelum mengajukan produk.</p>
                    <p>Setelah akun berhasil dibuat, Anda akan mendapatkan akses ke halaman mitra. Di sana, Anda dapat melihat berbagai menu untuk melengkapi data dan memantau proses pengajuan Anda. Pastikan informasi yang Anda masukkan benar agar admin dapat menghubungi Anda dengan mudah jika dibutuhkan verifikasi tambahan.</p>                    
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="visual-content">
                    <img src="assets/img/features/image 1.png" alt="" class="img-fluid">
                    <div class="floating-element">
                      <div class="floating-card">
                        <i class="bi bi-lightning-charge"></i>
                        <div class="card-info">
                          <span>Mudah & Cepat</span>
                          <strong> Daftar Mudah & Cepat</strong>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="tabs-tab-2">
              <div class="row align-items-center">
                <div class="col-lg-6">
                  <div class="content-area">
                    <div class="content-badge">
                      <i class="bi bi-database-add"></i>
                      <span>Masukkan Produk</span>
                    </div>
                    <h3>Masukkan Data Produk Anda</h3>
                    <p>Setelah akun aktif, lanjutkan dengan menambahkan data produk yang ingin diajukan. Isi informasi penting seperti nama produk, deskripsi singkat, jenis produk, dan kategori. Anda juga bisa menambahkan foto produk agar admin dapat menilai dengan lebih jelas.</p>
                    <p>Pastikan semua data sudah lengkap dan sesuai dengan kondisi produk sebenarnya. Semakin lengkap informasi yang Anda berikan, semakin cepat admin dapat melakukan peninjauan dan memberikan keputusan terhadap pengajuan Anda.</p>                    
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="visual-content">
                    <img src="assets/img/features/image 2.png" alt="Pitstop by Pertamina" class="img-fluid">
                    <div class="floating-element">
                      <div class="floating-card">
                        <i class="bi bi-graph-up-arrow"></i>
                        <div class="card-info">
                          <span>Data</span>
                          <strong>Data Statistik Produk Anda</strong>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="tabs-tab-3">
              <div class="row align-items-center">
                <div class="col-lg-6">
                  <div class="content-area">
                    <div class="content-badge">
                      <i class="bi bi-building-add"></i>
                      <span>Ajukan ke SPBU</span>
                    </div>
                    <h3>Ajukan ke SPBU yang Tersedia</h3>
                    <p>Jika data produk sudah lengkap, Anda bisa memilih SPBU tujuan yang tersedia di sistem. Pilih SPBU yang paling sesuai dengan wilayah atau kebutuhan distribusi produk Anda. Setelah memilih, kirim pengajuan langsung melalui halaman yang disediakan.</p>
                    <p>Setiap pengajuan akan otomatis masuk ke sistem admin untuk diperiksa. Proses ini memastikan produk Anda dikirim ke SPBU yang tepat dan sesuai dengan ketentuan yang berlaku. Anda juga bisa memantau status pengajuan langsung dari akun mitra Anda.</p>                   
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="visual-content">
                    <img src="assets/img/features/image 3.png" alt="Pitstop by Pertamina" class="img-fluid">
                    <div class="floating-element">
                      <div class="floating-card">
                        <i class="bi bi-cpu"></i>
                        <div class="card-info">
                          <span>Transparan</span>
                          <strong>Slot SPBU Dapat Dilihat</strong>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="tabs-tab-4">
              <div class="row align-items-center">
                <div class="col-lg-6">
                  <div class="content-area">
                    <div class="content-badge">
                      <i class="bi bi-phone-vibrate"></i>
                      <span>Admin akan Menghubungi</span>
                    </div>
                    <h3>Admin Akan Menghubungi Anda</h3>
                    <p>Setelah pengajuan dikirim, admin akan meninjau data dan dokumen yang Anda kirimkan. Jika semuanya sudah lengkap, admin akan menghubungi Anda untuk memberikan informasi lebih lanjut mengenai status pengajuan atau langkah berikutnya.</p>
                    <p>Apabila ada data yang perlu diperbaiki, Anda juga akan mendapatkan pemberitahuan melalui email atau pesan langsung di sistem. Dengan begitu, Anda bisa segera memperbarui informasi agar proses pendaftaran berjalan lancar tanpa harus menunggu terlalu lama.</p>
                    <div class="highlight-stats">                      
                    </div>                    
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="visual-content">
                    <img src="assets/img/features/image 4.png" alt="Pitstop by Pertamina" class="img-fluid">
                    <div class="floating-element">
                      <div class="floating-card">
                        <i class="bi bi-link-45deg"></i>
                        <div class="card-info">
                          <span> Terhubung</span>
                          <strong>Terhubung langsung dengan petugas</strong>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>

    </section><!-- /Tabs Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

      <!-- Section Title -->
      <div class="container section-title">
        <h2>Testimonials</h2>
        <p>Testimoni dari para mitra UMKM di Malang</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="testimonial-slider swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 4000
              },
              "slidesPerView": 1,
              "spaceBetween": 30,
              "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
              },
              "breakpoints": {
                "768": {
                  "slidesPerView": 2
                },
                "1200": {
                  "slidesPerView": 3
                }
              }
            }
          </script>

          <div class="swiper-wrapper">

            <!-- Testimonial Slide 1 -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="testimonial-header">
                  <img src="assets/img/person/person-m-12.webp" alt="Pitstop by Pertamina" class="img-fluid" loading="lazy">
                  <div class="rating">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <div class="testimonial-body">
                  <p>Slot di SPBU langsung ngangkat penjualan harian kami 2×. Prosesnya jelas dan cepat.</p>
                </div>
                <div class="testimonial-footer">
                  <h5>Aisyah</h5>
                  <span>Pemilik Roti Senja (Mitra UMKM)</span>
                  <div class="quote-icon">
                    <i class="bi bi-chat-quote-fill"></i>
                  </div>
                </div>
              </div>
            </div><!-- End Testimonial Slide -->

            <!-- Testimonial Slide 2 -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="testimonial-header">
                  <img src="assets/img/person/person-m-12.webp" alt="Pitstop by Pertamina" class="img-fluid" loading="lazy">
                  <div class="rating">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <div class="testimonial-body">
                  <p>Daftar, upload produk, ajukan lokasi—semua tinggal klik. Cocok buat UMKM sibuk.</p>
                </div>
                <div class="testimonial-footer">
                  <h5>David</h5>
                  <span>Pemilik Keripik Jamur (UMKM)</span>
                  <div class="quote-icon">
                    <i class="bi bi-chat-quote-fill"></i>
                  </div>
                </div>
              </div>
            </div><!-- End Testimonial Slide -->

            <!-- Testimonial Slide 3 -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="testimonial-header">
                  <img src="assets/img/person/person-m-12.webp" alt="Pitstop by Pertamina" class="img-fluid" loading="lazy">
                  <div class="rating">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <div class="testimonial-body">
                  <p>Respons tim cepat, SOP jelas, dan branding di area SPBU terasa profesional.</p>
                </div>
                <div class="testimonial-footer">
                  <h5>Amanda</h5>
                  <span>Brand Manager Kopi Tepi Jalan</span>
                  <div class="quote-icon">
                    <i class="bi bi-chat-quote-fill"></i>
                  </div>
                </div>
              </div>
            </div><!-- End Testimonial Slide -->

            <!-- Testimonial Slide 4 -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="testimonial-header">
                  <img src="assets/img/person/person-m-12.webp" alt="Pitstop by Pertamina" class="img-fluid" loading="lazy">
                  <div class="rating">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <div class="testimonial-body">
                  <p>Sejak masuk Pitstop, omzet snack kami stabil naik. Pengajuan lokasi ke SPBU juga tinggal klik.</p>
                </div>
                <div class="testimonial-footer">
                  <h5>Ryan</h5>
                  <span>Pemilik Cemal-Cemil Nusantara (Mitra UMKM)</span>
                  <div class="quote-icon">
                    <i class="bi bi-chat-quote-fill"></i>
                  </div>
                </div>
              </div>
            </div><!-- End Testimonial Slide -->

            <!-- Testimonial Slide 5 -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="testimonial-header">
                  <img src="assets/img/person/person-m-12.webp" alt="Pitstop by Pertamina" class="img-fluid" loading="lazy">
                  <div class="rating">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <div class="testimonial-body">
                  <p>Platform pitstop mudah digunakan dan sangat membantu dalam pemasaran produk saya</p>
                </div>
                <div class="testimonial-footer">
                  <h5>Rachel</h5>
                  <span>Pemilik Jamur Krispi Nusantara (Mitra UMKM)</span>
                  <div class="quote-icon">
                    <i class="bi bi-chat-quote-fill"></i>
                  </div>
                </div>
              </div>
            </div><!-- End Testimonial Slide -->

          </div>

          <div class="swiper-navigation">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>

        </div>

      </div>

    </section><!-- /Testimonials Section -->

    {{-- <!-- Pricing Section -->
    <section id="pricing" class="pricing section">

      <!-- Section Title -->
      <div class="container section-title">
        <h2>Pricing</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row justify-content-center g-4">

          <div class="col-lg-4 col-md-6">
            <div class="pricing-card starter">
              <div class="plan-header">
                <h3 class="plan-name">Starter</h3>
                <p class="plan-description">Perfect for individuals and small projects getting started.</p>
              </div>
              <div class="pricing-display">
                <div class="price">
                  <span class="currency">$</span>
                  <span class="amount">19</span>
                  <span class="period">/mo</span>
                </div>
              </div>
              <div class="features-list">
                <div class="feature">
                  <i class="bi bi-check2"></i>
                  <span>5 Projects</span>
                </div>
                <div class="feature">
                  <i class="bi bi-check2"></i>
                  <span>10GB Storage</span>
                </div>
                <div class="feature">
                  <i class="bi bi-check2"></i>
                  <span>Email Support</span>
                </div>
                <div class="feature">
                  <i class="bi bi-check2"></i>
                  <span>Basic Analytics</span>
                </div>
                <div class="feature">
                  <i class="bi bi-check2"></i>
                  <span>SSL Certificate</span>
                </div>
              </div>
              <a href="#" class="btn-plan">Get Started</a>
            </div>
          </div><!-- End Starter Plan -->

          <div class="col-lg-4 col-md-6">
            <div class="pricing-card professional featured">
              <div class="plan-header">
                <div class="featured-badge">Most Popular</div>
                <h3 class="plan-name">Professional</h3>
                <p class="plan-description">Ideal for growing businesses and teams that need more power.</p>
              </div>
              <div class="pricing-display">
                <div class="price">
                  <span class="currency">$</span>
                  <span class="amount">49</span>
                  <span class="period">/mo</span>
                </div>
              </div>
              <div class="features-list">
                <div class="feature">
                  <i class="bi bi-check2"></i>
                  <span>25 Projects</span>
                </div>
                <div class="feature">
                  <i class="bi bi-check2"></i>
                  <span>100GB Storage</span>
                </div>
                <div class="feature">
                  <i class="bi bi-check2"></i>
                  <span>Priority Support</span>
                </div>
                <div class="feature">
                  <i class="bi bi-check2"></i>
                  <span>Advanced Analytics</span>
                </div>
                <div class="feature">
                  <i class="bi bi-check2"></i>
                  <span>Team Collaboration</span>
                </div>
                <div class="feature">
                  <i class="bi bi-check2"></i>
                  <span>Custom Integrations</span>
                </div>
              </div>
              <a href="#" class="btn-plan">Start Free Trial</a>
            </div>
          </div><!-- End Professional Plan -->

          <div class="col-lg-4 col-md-6">
            <div class="pricing-card enterprise">
              <div class="plan-header">
                <h3 class="plan-name">Enterprise</h3>
                <p class="plan-description">Comprehensive solution for large organizations with specific needs.</p>
              </div>
              <div class="pricing-display">
                <div class="price">
                  <span class="currency">$</span>
                  <span class="amount">99</span>
                  <span class="period">/mo</span>
                </div>
              </div>
              <div class="features-list">
                <div class="feature">
                  <i class="bi bi-check2"></i>
                  <span>Unlimited Projects</span>
                </div>
                <div class="feature">
                  <i class="bi bi-check2"></i>
                  <span>1TB Storage</span>
                </div>
                <div class="feature">
                  <i class="bi bi-check2"></i>
                  <span>24/7 Phone Support</span>
                </div>
                <div class="feature">
                  <i class="bi bi-check2"></i>
                  <span>Enterprise Analytics</span>
                </div>
                <div class="feature">
                  <i class="bi bi-check2"></i>
                  <span>Advanced Security</span>
                </div>
                <div class="feature">
                  <i class="bi bi-check2"></i>
                  <span>Dedicated Account Manager</span>
                </div>
              </div>
              <a href="#" class="btn-plan">Contact Sales</a>
            </div>
          </div><!-- End Enterprise Plan -->

        </div>

        <div class="row justify-content-center mt-5">
          <div class="col-lg-8 text-center">
            <div class="pricing-footer">
              <p class="guarantee-text">30-day money-back guarantee • No setup fees • Cancel anytime</p>
              <p class="contact-text">Need a custom plan? <a href="#">Contact our sales team</a></p>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Pricing Section --> --}}

    {{-- <!-- Faq Section -->
    <section id="faq" class="faq section">

      <!-- Section Title -->
      <div class="container section-title">
        <h2>Frequently Asked Questions</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row justify-content-center">
          <div class="col-lg-9">

            <div class="faq-wrapper">

              <div class="faq-item faq-active">
                <div class="faq-header">
                  <span class="faq-number">01</span>
                  <h4>Donec sollicitudin molestie malesuada proin eget tortor?</h4>
                  <div class="faq-toggle">
                    <i class="bi bi-plus"></i>
                    <i class="bi bi-dash"></i>
                  </div>
                </div>
                <div class="faq-content">
                  <div class="content-inner">
                    <p>Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Donec rutrum congue leo eget malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae.</p>
                  </div>
                </div>
              </div><!-- End FAQ Item -->

              <div class="faq-item">
                <div class="faq-header">
                  <span class="faq-number">02</span>
                  <h4>Sed porttitor lectus nibh vivamus magna justo?</h4>
                  <div class="faq-toggle">
                    <i class="bi bi-plus"></i>
                    <i class="bi bi-dash"></i>
                  </div>
                </div>
                <div class="faq-content">
                  <div class="content-inner">
                    <p>Nulla porttitor accumsan tincidunt. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum porta. Vivamus suscipit tortor eget felis porttitor volutpat.</p>
                  </div>
                </div>
              </div><!-- End FAQ Item -->

              <div class="faq-item">
                <div class="faq-header">
                  <span class="faq-number">03</span>
                  <h4>Pellentesque habitant morbi tristique senectus?</h4>
                  <div class="faq-toggle">
                    <i class="bi bi-plus"></i>
                    <i class="bi bi-dash"></i>
                  </div>
                </div>
                <div class="faq-content">
                  <div class="content-inner">
                    <p>Quisque velit nisi, pretium ut lacinia in, elementum id enim. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec sollicitudin molestie malesuada.</p>
                  </div>
                </div>
              </div><!-- End FAQ Item -->

              <div class="faq-item">
                <div class="faq-header">
                  <span class="faq-number">04</span>
                  <h4>Lorem ipsum dolor sit amet consectetur adipiscing?</h4>
                  <div class="faq-toggle">
                    <i class="bi bi-plus"></i>
                    <i class="bi bi-dash"></i>
                  </div>
                </div>
                <div class="faq-content">
                  <div class="content-inner">
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium. Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.</p>
                  </div>
                </div>
              </div><!-- End FAQ Item -->

              <div class="faq-item">
                <div class="faq-header">
                  <span class="faq-number">05</span>
                  <h4>Curabitur aliquet quam id dui posuere blandit?</h4>
                  <div class="faq-toggle">
                    <i class="bi bi-plus"></i>
                    <i class="bi bi-dash"></i>
                  </div>
                </div>
                <div class="faq-content">
                  <div class="content-inner">
                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati.</p>
                  </div>
                </div>
              </div><!-- End FAQ Item -->

            </div>

          </div>
        </div>

      </div>

    </section><!-- /Faq Section --> --}}

    <!-- Team Section -->
    {{-- <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title">
        <h2>Team</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6">
            <div class="team-member d-flex">
              <div class="member-img">
                <img src="assets/img/person/person-m-7.webp" class="img-fluid" alt="" loading="lazy">
              </div>
              <div class="member-info flex-grow-1">
                <h4>Walter White</h4>
                <span>Chief Executive Officer</span>
                <p>Aliquam iure quaerat voluptatem praesentium possimus unde laudantium vel dolorum distinctio dire flow</p>
                <div class="social">
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                  <a href=""><i class="bi bi-youtube"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-6">
            <div class="team-member d-flex">
              <div class="member-img">
                <img src="assets/img/person/person-f-8.webp" class="img-fluid" alt="" loading="lazy">
              </div>
              <div class="member-info flex-grow-1">
                <h4>Sarah Jhonson</h4>
                <span>Product Manager</span>
                <p>Labore ipsam sit consequatur exercitationem rerum laboriosam laudantium aut quod dolores exercitationem ut</p>
                <div class="social">
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                  <a href=""><i class="bi bi-youtube"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-6">
            <div class="team-member d-flex">
              <div class="member-img">
                <img src="assets/img/person/person-m-6.webp" class="img-fluid" alt="" loading="lazy">
              </div>
              <div class="member-info flex-grow-1">
                <h4>William Anderson</h4>
                <span>CTO</span>
                <p>Illum minima ea autem doloremque ipsum quidem quas aspernatur modi ut praesentium vel tque sed facilis at qui</p>
                <div class="social">
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                  <a href=""><i class="bi bi-youtube"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-6">
            <div class="team-member d-flex">
              <div class="member-img">
                <img src="assets/img/person/person-f-4.webp" class="img-fluid" alt="" loading="lazy">
              </div>
              <div class="member-info flex-grow-1">
                <h4>Amanda Jepson</h4>
                <span>Accountant</span>
                <p>Magni voluptatem accusamus assumenda cum nisi aut qui dolorem voluptate sed et veniam quasi quam consectetur</p>
                <div class="social">
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                  <a href=""><i class="bi bi-youtube"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-6">
            <div class="team-member d-flex">
              <div class="member-img">
                <img src="assets/img/person/person-m-12.webp" class="img-fluid" alt="" loading="lazy">
              </div>
              <div class="member-info flex-grow-1">
                <h4>Brian Doe</h4>
                <span>Marketing</span>
                <p>Qui consequuntur quos accusamus magnam quo est molestiae eius laboriosam sunt doloribus quia impedit laborum velit</p>
                <div class="social">
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                  <a href=""><i class="bi bi-youtube"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-6">
            <div class="team-member d-flex">
              <div class="member-img">
                <img src="assets/img/person/person-f-9.webp" class="img-fluid" alt="" loading="lazy">
              </div>
              <div class="member-info flex-grow-1">
                <h4>Josepha Palas</h4>
                <span>Operation</span>
                <p>Sint sint eveniet explicabo amet consequatur nesciunt error enim rerum earum et omnis fugit eligendi cupiditate vel</p>
                <div class="social">
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                  <a href=""><i class="bi bi-youtube"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Team Section --> --}}

    <!-- Contact Section -->
    {{-- <section id="contact" class="contact section">
      <!-- Section Title -->
      <div class="container section-title">
        <h2>Contact</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row align-items-stretch">
          <div class="col-lg-7 order-lg-1 order-2">
            <div class="contact-form-container">
              <div class="form-intro">
                <h2>Let's Start a Conversation</h2>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur excepteur sint occaecat cupidatat.</p>
              </div>

              <form action="forms/contact.php" method="post" class="php-email-form contact-form">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-field">
                      <input type="text" name="name" class="form-input" id="userName" placeholder="Your Name" required="">
                      <label for="userName" class="field-label">Name</label>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-field">
                      <input type="email" class="form-input" name="email" id="userEmail" placeholder="Your Email" required="">
                      <label for="userEmail" class="field-label">Email</label>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-field">
                      <input type="tel" class="form-input" name="phone" id="userPhone" placeholder="Your Phone">
                      <label for="userPhone" class="field-label">Phone</label>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-field">
                      <input type="text" class="form-input" name="subject" id="messageSubject" placeholder="Subject" required="">
                      <label for="messageSubject" class="field-label">Subject</label>
                    </div>
                  </div>
                </div>

                <div class="form-field message-field">
                  <textarea class="form-input message-input" name="message" id="userMessage" rows="5" placeholder="Tell us about your project" required=""></textarea>
                  <label for="userMessage" class="field-label">Message</label>
                </div>

                <div class="my-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>

                <button type="submit" class="send-button">
                  Send Message
                  <span class="button-arrow">→</span>
                </button>
              </form>
            </div>
          </div>

          <div class="col-lg-5 order-lg-2 order-1">
            <div class="contact-sidebar">
              <div class="contact-header">
                <h3>Get in Touch</h3>
                <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim ad minim veniam quis nostrud.</p>
              </div>

              <div class="contact-methods">
                <div class="contact-method">
                  <div class="contact-icon">
                    <i class="bi bi-geo-alt"></i>
                  </div>
                  <div class="contact-details">
                    <span class="method-label">Address</span>
                    <p>892 Park Avenue, Manhattan<br>New York, NY 10075</p>
                  </div>
                </div>

                <div class="contact-method">
                  <div class="contact-icon">
                    <i class="bi bi-envelope"></i>
                  </div>
                  <div class="contact-details">
                    <span class="method-label">Email</span>
                    <p>hello@businessdemo.com</p>
                  </div>
                </div>

                <div class="contact-method">
                  <div class="contact-icon">
                    <i class="bi bi-telephone"></i>
                  </div>
                  <div class="contact-details">
                    <span class="method-label">Phone</span>
                    <p>+1 (555) 789-2468</p>
                  </div>
                </div>

                <div class="contact-method">
                  <div class="contact-icon">
                    <i class="bi bi-clock"></i>
                  </div>
                  <div class="contact-details">
                    <span class="method-label">Hours</span>
                    <p>Monday - Friday: 9AM - 6PM<br>Saturday: 10AM - 4PM</p>
                  </div>
                </div>
              </div>

              <div class="connect-section">
                <span class="connect-label">Connect with us</span>
                <div class="social-links">
                  <a href="#" class="social-link">
                    <i class="bi bi-linkedin"></i>
                  </a>
                  <a href="#" class="social-link">
                    <i class="bi bi-twitter-x"></i>
                  </a>
                  <a href="#" class="social-link">
                    <i class="bi bi-instagram"></i>
                  </a>
                  <a href="#" class="social-link">
                    <i class="bi bi-facebook"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Contact Section --> --}}

  </main>

  <footer id="footer" class="footer position-relative light-background">

    <div class="container">
      <div class="row gy-5">

        <div class="col-lg-4">
          <div class="footer-content">
            <a href="" class="logo d-flex align-items-center mb-4">              
              <img src="images/logo.png" alt="">
            </a>
            <p class="mb-4"> PITSTOP By Pertamina adalah platform khusus UMKM F&B untuk dapat menjual produknya di SPBU tanpa perlu menyewa tempat atau lahan. 
Pitstoper (salesman Pitstop) akan menawarkan produk UMKM Anda langsung ke depan konsumen. Dengan traffic konsumen di SPBU, Pitstop akan 
menjadi salah satu Solusi dalam menaikkan penjualan sekaligus meningkatkan pengenalan nama akan produk-produk Anda di masyarakat.</p>

            {{-- <div class="newsletter-form">
              <h5>Stay Updated</h5>
              <form action="forms/newsletter.php" method="post" class="php-email-form">
                <div class="input-group">
                  <input type="email" name="email" class="form-control" placeholder="Enter your email" required="">
                  <button type="submit" class="btn-subscribe">
                    <i class="bi bi-send"></i>
                  </button>
                </div>
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Thank you for subscribing!</div>
              </form>
            </div> --}}
          </div>
        </div>

        {{-- <div class="col-lg-2 col-6">
          <div class="footer-links">
            <h4>Company</h4>
            <ul>
              <li><a href="#"><i class="bi bi-chevron-right"></i> About</a></li>
              <li><a href="#"><i class="bi bi-chevron-right"></i> Careers</a></li>
              <li><a href="#"><i class="bi bi-chevron-right"></i> Press</a></li>
              <li><a href="#"><i class="bi bi-chevron-right"></i> Blog</a></li>
              <li><a href="#"><i class="bi bi-chevron-right"></i> Contact</a></li>
            </ul>
          </div>
        </div> --}}

        {{-- <div class="col-lg-2 col-6">
          <div class="footer-links">
            <h4>Solutions</h4>
            <ul>
              <li><a href="#"><i class="bi bi-chevron-right"></i> Digital Strategy</a></li>
              <li><a href="#"><i class="bi bi-chevron-right"></i> Cloud Computing</a></li>
              <li><a href="#"><i class="bi bi-chevron-right"></i> Data Analytics</a></li>
              <li><a href="#"><i class="bi bi-chevron-right"></i> AI Solutions</a></li>
              <li><a href="#"><i class="bi bi-chevron-right"></i> Cybersecurity</a></li>
            </ul>
          </div>
        </div> --}}

        <div class="col-lg-4 order-lg-2 ms-lg-auto">
          <div class="footer-contact">
            <h4>Hubungi Kami</h4>
            <div class="contact-item">
              <div class="contact-icon">
                <i class="bi bi-geo-alt"></i>
              </div>
              <div class="contact-info">
                <p>Jl. Buring No.24, Oro-oro Dowo,<br>Kec. Klojen, Kota Malang, Jawa Timur<br>65119</p>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">
                <i class="bi bi-telephone"></i>
              </div>
              <div class="contact-info">
                <p>+62 81352922555</p>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">
                <i class="bi bi-envelope"></i>
              </div>
              <div class="contact-info">
                <p>pertamina.pitstop.mlg@gmail.com</p>
              </div>
            </div>

            <div class="social-links">
              {{-- <a href="#"><i class="bi bi-facebook"></i></a>
              <a href="#"><i class="bi bi-twitter-x"></i></a>
              <a href="#"><i class="bi bi-linkedin"></i></a>
              <a href="#"><i class="bi bi-youtube"></i></a>
              <a href="#"><i class="bi bi-github"></i></a> --}}
            </div>
          </div>
        </div>

      </div>
    </div>


  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>