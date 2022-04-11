<?php
    use App\User;
    use App\Models\Userinfo;

    $newUser = User::first();
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="mobile-only-brand pull-left">
        <div class="nav-header pull-left">
            <div class="logo-wrap">
                <a href="<?php echo e(route('home')); ?>">
                    <img class="brand-img" src="<?php echo e(asset('plugins/logo.png')); ?>" width="65" alt=""/>
                    <span class="brand-text">IEC</span>
                </a>
            </div>
        </div>	
        <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
        <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
        
        
    </div>
    <div id="mobile_only_nav" class="mobile-only-nav pull-right">
        <ul class="nav navbar-right top-nav pull-right">
            
            <li class="dropdown auth-drp">
                <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="<?php echo e(asset('plugins/user1.png')); ?>" alt="Admin" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
                <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <li>
                        <a href="<?php echo e(route("profile")); ?>"><i class="zmdi zmdi-account"></i><span>Profile</span></a>
                    </li>
                    <li class="divider"></li>
                  
                    <li>
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <?php echo e(__('Logout')); ?>

                        </a>

                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>	
</nav>

<?php if($message = Session::get('message')): ?>
<div class="jq-toast-wrap top-right">
        <div class="jq-toast-single jq-has-icon jq-icon-success" style="text-align: left; display: relate;">
            <span class="jq-toast-loader jq-toast-loaded" style="-webkit-transition: width 3.1s ease-in; -o-transition: width 3.1s ease-in;                       transition: width 3.1s ease-in;                       background-color: #fec107;"></span>
            <span class="close-jq-toast-single">×</span>
            <h2 class="jq-toast-heading"><?php echo e($message); ?></h2>
        </div>
    </div>
<?php endif; ?>

<?php if($message = Session::get('error')): ?>
<div class="jq-toast-wrap top-right">
        <div class="jq-toast-single jq-has-icon jq-icon-danger" style="text-align: left; display: relate;">
            <span class="jq-toast-loader jq-toast-loaded" style="-webkit-transition: width 3.1s ease-in; -o-transition: width 3.1s ease-in;                       transition: width 3.1s ease-in;                       background-color: #fec107;"></span>
            <span class="close-jq-toast-single">×</span>
            <h2 class="jq-toast-heading"><?php echo e($error); ?></h2>
        </div>
    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\iec\resources\views/admin/section/top-navbar.blade.php ENDPATH**/ ?>