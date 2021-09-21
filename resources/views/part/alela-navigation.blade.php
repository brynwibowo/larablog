        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{route('dashboard')}}" class="site_title">
              <i class="fa fa-cube"></i><span> {{env('APP_NAME')}}</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              
              <div class="profile_pic">
               <img src="{{asset('images/default-user.png')}}" alt="" class="img-circle profile_img"> 
              </div>
              
              <div class="profile_info">
                <span>Assalamu'alaikum,</span>
                <h2>{{Auth::user()->name}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>MENU</h3>
                <ul class="nav side-menu">
                  <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a>
                  </li>
                  <li><a href="{{route('content')}}"><i class="fa fa-edit"></i> Contents</a>
                   </li>
                   @if(Auth::user()->level == 'admin')
                  <li><a href="{{route('user')}}"><i class="fa fa-users"></i> Users</a>
                    </li>
                  <li><a href="{{route('content-gallery')}}"><i class="fa fa-image"></i> Gallery</a>
                  </li>
                  <li><a><i class="fa fa-bank"></i> Profil <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                      <li><a  href="{{route('content-profil')}}">Nurul Ummah</a></li>
                      <li><a href="#">Personal</a></li>
                    </ul>
                </li>
                  <li><a href="{{route('content-photo-slide')}}"><i class="fa fa-file-image-o"></i> Foto Slide</a>
                    </li>
                    @endif
                </ul>
              </div>
              <!-- tambahkan menu section disini -->

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              
              <a data-toggle="tooltip" data-placement="top" title="Logout" 
              href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>