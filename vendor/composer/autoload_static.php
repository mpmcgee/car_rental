<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfe4c4fae442cdb8392988156c0594d3d
{
    public static $classMap = array (
        'Booking' => __DIR__ . '/../..' . '/models/booking.class.php',
        'BookingController' => __DIR__ . '/../..' . '/controllers/booking_controller.class.php',
        'BookingDetail' => __DIR__ . '/../..' . '/views/booking/detail/booking_detail.class.php',
        'BookingError' => __DIR__ . '/../..' . '/views/booking/error/booking_error.class.php',
        'BookingIndex' => __DIR__ . '/../..' . '/views/booking/index/booking_index.class.php',
        'BookingIndexView' => __DIR__ . '/../..' . '/views/booking/booking_index_view.class.php',
        'BookingModel' => __DIR__ . '/../..' . '/models/booking_model.class.php',
        'BookingSearch' => __DIR__ . '/../..' . '/views/booking/search/booking_search.class.php',
        'ComposerAutoloaderInitfe4c4fae442cdb8392988156c0594d3d' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInitfe4c4fae442cdb8392988156c0594d3d' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Database' => __DIR__ . '/../..' . '/application/database.class.php',
        'Dispatcher' => __DIR__ . '/../..' . '/application/dispatcher.class.php',
        'IndexView' => __DIR__ . '/../..' . '/views/index_view.class.php',
        'Login' => __DIR__ . '/../..' . '/views/user/login/login.class.php',
        'Logout' => __DIR__ . '/../..' . '/views/user/logout/logout.class.php',
        'Register' => __DIR__ . '/../..' . '/views/user/index/register.class.php',
        'Reset' => __DIR__ . '/../..' . '/views/user/reset/reset.class.php',
        'ResetConfirm' => __DIR__ . '/../..' . '/views/user/reset/reset_confirm.class.php',
        'User' => __DIR__ . '/../..' . '/models/user.class.php',
        'UserController' => __DIR__ . '/../..' . '/controllers/user_controller.class.php',
        'UserError' => __DIR__ . '/../..' . '/views/user/error/user_error.class.php',
        'UserIndexView' => __DIR__ . '/../..' . '/views/user/user_index_view.class.php',
        'UserModel' => __DIR__ . '/../..' . '/models/user_model.class.php',
        'UserRegister' => __DIR__ . '/../..' . '/views/user/index/user_register.class.php',
        'Vehicle' => __DIR__ . '/../..' . '/models/vehicle.class.php',
        'VehicleController' => __DIR__ . '/../..' . '/controllers/vehicle_controller.class.php',
        'VehicleError' => __DIR__ . '/../..' . '/views/vehicle/error/vehicle_error.class.php',
        'VehicleIndex' => __DIR__ . '/../..' . '/views/vehicle/index/vehicle_index.class.php',
        'VehicleIndexView' => __DIR__ . '/../..' . '/views/vehicle/vehicle_index_view.class.php',
        'VehicleModel' => __DIR__ . '/../..' . '/models/vehicle_model.class.php',
        'VehicleSearch' => __DIR__ . '/../..' . '/views/vehicle/search/vehicle_search.class.php',
        'VerifyUser' => __DIR__ . '/../..' . '/views/user/login/verify_user.class.php',
        'WelcomeController' => __DIR__ . '/../..' . '/controllers/welcome.controller.class.php',
        'WelcomeIndex' => __DIR__ . '/../..' . '/views/welcome/welcome_index.class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitfe4c4fae442cdb8392988156c0594d3d::$classMap;

        }, null, ClassLoader::class);
    }
}
