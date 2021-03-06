<!DOCTYPE html>
<html lang="en">
<head>
    <?php   $title=  \App\Config::where('config', '=', 'hotel_name')->first()->value;   ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{'Dashboard - '.  $title}}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ URL::asset('css/dashboard-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/dashboard.css') }}" rel="stylesheet">
    @yield('header')
</head>
<body>
@include('modals.users.account-modal')
@include('modals.upload-avatar-modal')
<nav class="navbar navbar-default navbar-fixed-top navbar-main">
    <div class="container-fluid">
        <div class="col-xs-12 col-sm-2 col-md-2" id="collapse-parent">
            <div class="navbar-header">

                <a class="navbar-brand text-uppercase" href="/dashboard">{{$title}}</a>
                <button type="button" class="navbar-toggle collapsed accordion-btn toggle-btn-sidebar" data-toggle="collapse" data-parent="#collapse-parent" data-target="#dashboard-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="glyphicon glyphicon-align-justify collapse-icon"></span>
                </button>
                <button type="button" class="navbar-toggle collapsed accordion-btn" data-toggle="collapse" data-target="#dashboard-sidebar-collapse">
                    <span class="sr-only">Toggle sidebar navigation</span>
                    <span class="glyphicon glyphicon-align-left collapse-icon"></span>
                </button>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="dashboard-navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span style="margin-right: 0.5em"> {{ Auth::user()->name }} </span>
                        <img class="img-circle pull-right avatar-image" src="/images/users/avatars/{{Auth::user()->img}}" style="max-width:25px; max-height: 25px">
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="#" data-target="#accountModal" data-toggle="modal">
                                <i class="fa fa-btn fa-cog fa-fw"></i>&nbsp; Settings</a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#uploadAvatarModal">
                                <i class="fa fa-btn fa-picture-o fa-fw"></i>&nbsp;
                                Change avatar
                            </a>
                        </li>
                        <li><a href="/logout"><i class="fa fa-btn fa-sign-out fa-fw"></i>&nbsp; Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-second-row">
   <div class="col-xs-12 col-sm-3 col-md-2 nav-sidebar">
       <ul class="nav nav-pills nav-stacked collapse navbar-collapse" id="dashboard-sidebar-collapse">
           @if(\Auth::user()->isManager())
               <li @if(isset($active) && $active == 'configs') class="active" @endif>
                   <a href="/dashboard/configs">
                       <i class="fa fa-wrench fa-fw"></i>&nbsp;
                       Configuration
                   </a>
               </li>
               <li @if(isset($active) && $active == 'rooms') class="active" @endif>
                   <a href="/dashboard/rooms">
                       <i class="fa fa-bed fa-fw"></i>&nbsp;
                       Rooms
                   </a>
               </li>
               <li @if(isset($active) && $active == 'meals') class="active" @endif>
                   <a href="/dashboard/meals">
                       <i class="fa fa-apple fa-fw"></i>&nbsp;
                       Meals
                   </a>
               </li>

               <li @if(isset($active) && $active == 'drinks') class="active" @endif>
                   <a href="/dashboard/drinks">
                       <i class="fa fa-glass fa-fw"></i>&nbsp;
                       Drinks
                   </a>
               </li>
               <li @if(isset($active) && $active == 'tables') class="active" @endif>
                   <a href="/dashboard/tables">
                       <i class="fa fa-cutlery fa-fw"></i>&nbsp;
                       Tables
                   </a>
               </li>
               <li @if(isset($active) && $active == 'activities') class="active" @endif>
                   <a href="/dashboard/activities">
                       <i class="fa fa-shopping-cart fa-fw"></i>&nbsp;
                       Activities
                   </a>
               </li>
           @endif
           @if(\Auth::user()->isAdmin() || \Auth::user()->isManager())
               <li @if(isset($active) && $active == 'users') class="active" @endif>
                   <a href="/dashboard/users">
                       <i class="fa fa-users fa-fw"></i>&nbsp;
                       Users
                   </a>
               </li>
           @endif
           @if(\Auth::user()->isStaff())
               <li @if(isset($active) && $active == 'reservations') class="active" @endif>
                   <a href="/dashboard/reservations">
                       <i class="fa fa-calendar fa-fw"></i>&nbsp;
                       Hotel check-ins
                   </a>
               </li>
               <li @if(isset($active) && $active == 'table-reservations') class="active" @endif>
                   <a href="/dashboard/table-reservations">
                       <i class="fa fa-table fa-fw"></i>&nbsp;
                       Diner check-ins
                   </a>
               </li>
               <li @if(isset($active) && $active == 'activity-reservations') class="active" @endif>
                   <a href="/dashboard/activity-reservations">
                       <i class="fa fa-cart-plus fa-fw"></i>&nbsp;
                       In-room orders
                   </a>
               </li>
           @endif
           <li>
               <a href="/" target="_blank">
                   <i class="fa fa-globe fa-fw"></i>&nbsp;
                   Website
               </a>
           </li>
       </ul>
    </div>
    <div class="col-xs-12 col-sm-9 col-md-10 content-section">
        <div class="row">
            @yield('content')
        </div>
    </div>
</div>

<!-- JavaScripts -->
<script src="{{ URL::asset('js/jquery-1.12.3.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/dashboard.js') }}"></script>
@yield('footer')
</body>