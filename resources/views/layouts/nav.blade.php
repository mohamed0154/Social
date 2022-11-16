  <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4 st_nav">
            <div class="container-fluid st_nav" >

                <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="../pages/dashboard.html">
                   <span class="web_name">Mf</span>
                </a>

              <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </span>
              </button>
              <div class="collapse navbar-collapse st_navigation" id="navigation">
                <ul class="navbar-nav mx-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="../pages/dashboard.html">
                            <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                            Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-2" href="../pages/profile.html">
                              <i class="fa fa-user opacity-6 text-dark me-1"></i>
                              Profile
                            </a>
                        </li>
                    @endauth
                  <li class="nav-item">
                    <a class="nav-link me-2" href="{{route('register')}}">
                      <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                      Sign Up
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link me-2" href="{{route('login')}}">
                      <i class="fas fa-key opacity-6 text-dark me-1"></i>
                      Sign In
                    </a>
                  </li>
                </ul>
                <ul class="navbar-nav d-lg-block d-none">
                  <li class="nav-item">
                    <a href="/" class="btn btn-sm btn-round mb-0 me-1 bg-gradient-dark">InterFace</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
