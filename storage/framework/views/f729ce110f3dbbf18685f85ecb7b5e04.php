<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/logo/wngez-icon.png')); ?>" type="image/png">
    <title><?php echo e(__('Login')); ?> - WngeZ.com</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/main/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/extensions/toastify-js/toastify.css')); ?>">
    <script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/extensions/toastify-js/toastify.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/parsley.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/custom/function.js')); ?>"></script>
    <style>
        :root{--blue:#0967ed;--cyan:#08a9ee;--navy:#071430;--muted:#687795}*{box-sizing:border-box}html,body{width:100%;min-height:100%;margin:0}body{font-family:'Plus Jakarta Sans',Arial,sans-serif;color:var(--navy);background:#f3f8ff}.phpdebugbar,#phpdebugbar{display:none!important}.login-page{min-height:100vh;display:grid;grid-template-columns:minmax(0,62.8%) minmax(440px,37.2%);overflow:hidden}
        .marketplace-visual{min-height:100vh;background-color:#06469b;background-image:url('<?php echo e(asset('assets/images/bg/login_showcase.png')); ?>');background-repeat:no-repeat;background-size:100% 100%;background-position:center}
        .login-side{min-height:100vh;position:relative;display:flex;align-items:flex-start;justify-content:flex-start;padding:106px 49px 54px 0;background:radial-gradient(circle at 15% 2%,rgba(103,185,255,.25),transparent 31%),linear-gradient(145deg,#eef7ff 0%,#f8fbff 45%,#fff 100%)}
        .top-link{position:absolute;top:28px;right:46px;display:flex;align-items:center;gap:16px;font-size:14px;color:#66728b}.visit-btn{display:inline-flex;align-items:center;gap:10px;padding:12px 24px;border-radius:999px;background:#e1ecff;color:#075ce0;text-decoration:none;font-weight:700;transition:.2s}.visit-btn:hover{color:#075ce0;transform:translateY(-1px);box-shadow:0 8px 20px rgba(20,100,220,.12)}
        .auth-card{width:100%;max-width:573px;min-height:781px;padding:55px 43px 45px;border:1px solid rgba(255,255,255,.9);border-radius:28px;background:rgba(255,255,255,.96);box-shadow:0 28px 70px rgba(40,99,170,.14)}.brand{display:flex;justify-content:center;margin-bottom:36px}.brand img{display:block;width:min(100%,295px);height:88px;object-fit:contain}.welcome{margin:0 0 10px;text-align:center;font-size:31px;line-height:1.2;font-weight:800;letter-spacing:-.8px}.subtitle{max-width:390px;margin:0 auto 28px;text-align:center;color:var(--muted);font-size:15px;line-height:1.65}
        .field{position:relative;margin-bottom:18px}.field i{position:absolute;z-index:2;top:50%;transform:translateY(-50%);color:#71819e;font-size:20px}.field .leading{left:21px}.field .trailing{right:20px;cursor:pointer}.field input{width:100%;height:69px;padding:25px 54px 10px 66px;border:1px solid #d8e2f0;border-radius:13px;outline:0;background:#f4f8fe;color:#0c1730;font-size:15px;font-weight:500;transition:.2s}.field label{position:absolute;z-index:2;left:66px;top:12px;color:#71809a;font-size:12px;pointer-events:none}.field input:focus{background:#fff;border-color:#2382ee;box-shadow:0 0 0 4px rgba(35,130,238,.1)}
        .options{display:flex;align-items:center;justify-content:space-between;gap:20px;margin:4px 0 25px}.remember{display:flex;align-items:center;gap:10px;color:#5e6e8a;font-size:14px;cursor:pointer}.remember input{width:19px;height:19px;margin:0;accent-color:#0876ed}.forgot{color:#0666e8;font-size:14px;font-weight:500;text-decoration:none}.login-btn{width:100%;height:61px;display:flex;align-items:center;justify-content:center;gap:12px;border:0;border-radius:12px;background:linear-gradient(100deg,#0b68ee,#08a9ed);color:#fff;font-size:16px;font-weight:700;box-shadow:0 13px 27px rgba(15,121,232,.25);cursor:pointer;transition:.2s}.login-btn:hover{transform:translateY(-1px);box-shadow:0 15px 30px rgba(15,121,232,.32)}
        .divider{display:flex;align-items:center;gap:20px;margin:27px 0;color:#73819b;font-size:12px;font-weight:600}.divider:before,.divider:after{content:'';height:1px;flex:1;background:#d9e0e9}.secure{display:flex;align-items:center;gap:15px;padding:16px 19px;border-radius:14px;background:#f3f7fc}.secure-icon{width:38px;height:38px;display:grid;place-items:center;flex:0 0 auto;color:#0871ed;font-size:25px}.secure strong{display:block;color:#0d438f;font-size:13px;margin-bottom:3px}.secure span{display:block;color:#7b879b;font-size:11px;line-height:1.45}.error{display:block;margin:-10px 5px 13px;color:#dc3545;font-size:12px;font-weight:600}.demo-note{color:#dc3545;text-align:center;margin-top:14px;font-size:12px;font-weight:600}.demo-buttons{display:grid;grid-template-columns:1fr 1fr;gap:10px}.demo-buttons button{padding:10px;border:1px solid #0b73ea;border-radius:9px;background:#fff;color:#0b73ea;font-weight:700;cursor:pointer}
        @media(max-width:1180px){.login-page{grid-template-columns:minmax(0,56%) minmax(430px,44%);overflow:visible}.marketplace-visual{background-size:cover;background-position:center}.login-side{align-items:center;justify-content:center;padding:88px 30px 48px}.auth-card{min-height:0;padding-left:35px;padding-right:35px}}@media(max-width:900px){.login-page{display:block}.marketplace-visual{display:none}.login-side{padding:92px 20px 35px}.top-link{top:22px;right:24px}.auth-card{max-width:560px}}@media(max-width:520px){.login-side{padding-left:12px;padding-right:12px}.top-link>span{display:none}.visit-btn{padding:10px 16px}.auth-card{padding:38px 22px 30px;border-radius:22px}.brand{margin-bottom:27px}.brand img{height:72px}.welcome{font-size:25px}.options{align-items:flex-start}}
    </style>
</head>
<body>
<main class="login-page">
    <section class="marketplace-visual" aria-label="WngeZ marketplace"></section>
    <section class="login-side">
        <nav class="top-link" aria-label="Website navigation"><span><?php echo e(__('New here?')); ?></span><a href="<?php echo e(url('/')); ?>" class="visit-btn"><?php echo e(__('Visit Website')); ?> <i class="bi bi-arrow-right"></i></a></nav>
        <div class="auth-card">
            <div class="brand"><img src="<?php echo e(asset('assets/images/logo/wngez-logo.png')); ?>" alt="WngeZ.com - Buy, Sell, Done!"></div>
            <h1 class="welcome"><?php echo e(__('Hi, Welcome Back!')); ?></h1>
            <p class="subtitle"><?php echo e(__('Enter your details to sign in to your dashboard and manage your marketplace.')); ?></p>
            <form method="POST" action="<?php echo e(route('login')); ?>" id="frmLogin"><?php echo csrf_field(); ?>
                <div class="field"><i class="bi bi-envelope leading"></i><label for="email"><?php echo e(__('Email address')); ?></label><input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="admin@wngez.com" required autocomplete="email" autofocus></div>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="error" role="alert"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="field"><i class="bi bi-lock leading"></i><label for="password"><?php echo e(__('Password')); ?></label><input id="password" type="password" name="password" placeholder="••••••••••••" required autocomplete="current-password"><i class="bi bi-eye trailing" id="toggle_pass" role="button" aria-label="Show password"></i></div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="error" role="alert"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="options"><label class="remember"><input type="checkbox" name="remember" <?php echo e(old('remember', true) ? 'checked' : ''); ?>><span><?php echo e(__('Remember me')); ?></span></label><a href="<?php echo e(route('admin.forgot-password')); ?>" class="forgot"><?php echo e(__('Forgot Password ?')); ?></a></div>
                <button type="submit" class="login-btn login_btn"><span><?php echo e(__('Log in')); ?></span><i class="bi bi-arrow-right"></i></button>
                <?php if(config('app.demo_mode')): ?>
                    <div class="demo-note"><?php echo e(__('If you cannot login, then Click Here.')); ?></div><div class="divider">DEMO CREDENTIALS</div><div class="demo-buttons"><button type="button" id="admin_btn"><?php echo e(__('Admin')); ?></button><button type="button" id="staff_btn"><?php echo e(__('Staff')); ?></button></div>
                <?php else: ?>
                    <div class="divider">OR</div><div class="secure"><div class="secure-icon"><i class="bi bi-shield-check"></i></div><div><strong><?php echo e(__('Secure Admin Access')); ?></strong><span><?php echo e(__('Your data is protected with industry-standard security.')); ?></span></div></div>
                <?php endif; ?>
            </form>
        </div>
    </section>
</main>
<script>
$('#toggle_pass').on('click',function(){const input=$('#password'),show=input.attr('type')==='password';input.attr('type',show?'text':'password');$(this).toggleClass('bi-eye bi-eye-slash').attr('aria-label',show?'Hide password':'Show password')});
<?php if(config('app.demo_mode')): ?>
$('#admin_btn').on('click',function(){$('#email').val('admin@gmail.com');$('#password').val('admin123');$('#frmLogin').trigger('submit')});$('#staff_btn').on('click',function(){$('#email').val('staff@gmail.com');$('#password').val('Staff@123');$('#frmLogin').trigger('submit')});
<?php endif; ?>
$('#frmLogin').on('submit',function(){$('.login_btn').html('<span class="spinner-border spinner-border-sm" role="status"></span> Loading...').prop('disabled',true)});
</script>
</body>
</html>
<?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/dashboard/resources/views/auth/login.blade.php ENDPATH**/ ?>