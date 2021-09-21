<!-- top navigation -->
<div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="{{asset('images/avatar/default-user.png')}}" alt="">
                      {{Auth::user()->name}}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  href="{{ route('profile.show') }}"> Profile</a>
                      <a class="dropdown-item" target="__blank"  href="https://api.whatsapp.com/send?phone=628978117371&text=Assalamu'alaikum,%20Saya%20dari%20Ponpes%20Nurul%20Ummah%20ingin%20bertanya">
                      <i class="fa fa-wechat pull-right"></i> Bantuan</a>
                     
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                      <a class="dropdown-item"  href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                      </form>
                    </div>
                  </li>
                  
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->