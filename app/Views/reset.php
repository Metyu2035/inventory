<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VBI | RESET PASSWORD</title>

    <!-- Logo Samping Website -->
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo1.png') ?>" type="image/x-icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Poppins&family=Roboto:wght@500&display=swap" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- AdminLte CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css" integrity="sha512-IuO+tczf4J43RzbCMEFggCWW5JuX78IrCJRFFBoQEXNvGI6gkUw4OjuwMidiS4Lm9Q2lILzpJwZuMWuSEeT9UQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/alt/adminlte.components.min.css" integrity="sha512-C6GDY2X+A6W2CYRoEykmm+Ta04hV2TqOSer0LJ+TeZCY3+b9i9pDnbwNgvlrpZSZIgBonixchcyVe7Nu8ccauQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/alt/adminlte.core.min.css" integrity="sha512-xihZdz1B0BgSS+aKKZn3WCVokTH1I/KbsubJJ/jfk9ir22aAtbFHw+oGPvKJUX76Wtl3kKhO+Wkj6Z47Pa76VQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/alt/adminlte.extra-components.min.css" integrity="sha512-Rho/nal+5pKgEFMfnMeJ5iynqFe2y/ev+KwrKIzFALivzIkj+3ymOWzhY/T9m5v9pkDUxZevORjoavsYCVbU/w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/alt/adminlte.light.min.css" integrity="sha512-sH43x9hDH6VYZCimbGd58vYrO4uMdmPn3m8QUgxNYi4MNmj4sbt+fN1jG+TnVA2Q0SA6tvEo6W6P1Z0FA+6AXA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/alt/adminlte.pages.min.css" integrity="sha512-G5uca2T4CI7/9IHrOI1DKXQaqBN17tyNzgL4rMSEavhnKwN82WDWptayW8/VbzI21UCjpErfXv7jRve+iCbb9g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/alt/adminlte.plugins.min.css" integrity="sha512-ayIIFF0UuqVTtj88SVYRvEcSf+vs9aLDgte4Fd+jdsFFr3zJYo5wEjFFD0QXCM+3WrVUCyUAW8meKc2kzO5Tow==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/eduhoster.css">

    <script nonce="e6156b3f-e5a6-48ca-aae4-265b0623eea7">
        (function(w, d) {
            ! function(a, e, t, r) {
                a.zarazData = a.zarazData || {};
                a.zarazData.executed = [];
                a.zaraz = {
                    deferred: [],
                    listeners: []
                };
                a.zaraz.q = [];
                a.zaraz._f = function(e) {
                    return function() {
                        var t = Array.prototype.slice.call(arguments);
                        a.zaraz.q.push({
                            m: e,
                            a: t
                        })
                    }
                };
                for (const e of ["track", "set", "debug"]) a.zaraz[e] = a.zaraz._f(e);
                a.zaraz.init = () => {
                    var t = e.getElementsByTagName(r)[0],
                        z = e.createElement(r),
                        n = e.getElementsByTagName("title")[0];
                    n && (a.zarazData.t = e.getElementsByTagName("title")[0].text);
                    a.zarazData.x = Math.random();
                    a.zarazData.w = a.screen.width;
                    a.zarazData.h = a.screen.height;
                    a.zarazData.j = a.innerHeight;
                    a.zarazData.e = a.innerWidth;
                    a.zarazData.l = a.location.href;
                    a.zarazData.r = e.referrer;
                    a.zarazData.k = a.screen.colorDepth;
                    a.zarazData.n = e.characterSet;
                    a.zarazData.o = (new Date).getTimezoneOffset();
                    a.zarazData.q = [];
                    for (; a.zaraz.q.length;) {
                        const e = a.zaraz.q.shift();
                        a.zarazData.q.push(e)
                    }
                    z.defer = !0;
                    for (const e of [localStorage, sessionStorage]) Object.keys(e || {}).filter((a => a.startsWith("_zaraz_"))).forEach((t => {
                        try {
                            a.zarazData["z_" + t.slice(7)] = JSON.parse(e.getItem(t))
                        } catch {
                            a.zarazData["z_" + t.slice(7)] = e.getItem(t)
                        }
                    }));
                    z.referrerPolicy = "origin";
                    z.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(a.zarazData)));
                    t.parentNode.insertBefore(z, t)
                };
                ["complete", "interactive"].includes(e.readyState) ? zaraz.init() : a.addEventListener("DOMContentLoaded", zaraz.init)
            }(w, d, 0, "script");
        })(window, document);
    </script>
</head>

<body class="body-edu">
    <div class="latar isi bg-image">
        <div class="login-box">
            <!-- Notifikasi bila terdapat error -->
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger" role="alert">
                    <div class="row">
                        <div class="col-11">
                            <h6 class="alert-heading">PERHATIAN !!!</h6>
                        </div>
                        <div class="col-1">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="">
                        <h6><?php echo session()->getFlashdata('error'); ?></h6>
                    </div>
                    <?php echo session()->remove('error'); ?>
                </div>
            <?php endif; ?>

            <!-- Notifikasi bila terdapat pesan -->
            <?php if (!empty(session()->getFlashdata('pesan'))) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <div class="col-12">
                        <?php echo session()->getFlashdata('pesan'); ?>
                        <?php echo session()->remove('pesan'); ?>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <!-- Card Login Start -->
            <div class="card">
                <div class="card-body login-card-body" id="card-edu">

                    <!-- Logo Perusahaan -->
                    <div class="login-logo">
                        <img class="img-fluid" id="perusahaan" src="<?= base_url('assets/img/logo_perusahaan1.png') ?>" alt="Logo Perusahaan">
                    </div>

                    <!-- Judul Login -->
                    <p style="text-align: center; font-size: 14px;">Silahkan masukan password anda !</p>

                    <!-- Form Login -->
                    <form action="<?= base_url('home/prosesReset') ?>" method="post">
                        <?php foreach ($user as $row) : ?>

                        <?php endforeach ?>
                        <!-- ID -->
                        <div class="input-group mb-3">
                            <input hidden name="id" id="border-edu" value="<?= $row['id_user'] ?>" type="text" class="form-control">
                        </div>

                        <!-- Password -->
                        <div class="input-group mb-3">
                            <input autofocus placeholder="Masukan Password !" name="password" id="border-edu" type="password" class="form-control">
                            <div class="input-group-append">
                                <div id="border-edu" class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-4"></div>
                            <div class="col-3"></div>
                            <div class="col-5">
                                <button id="btn-edu" type="submit" class="btn btn-block">Proses</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Card Login End -->
                <div class="row mt-4">

                </div>
            </div>
        </div>
    </div>

    <!-- AdminLTE JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js" integrity="sha512-KBeR1NhClUySj9xBB0+KRqYLPkM6VvXiiWaSz/8LCQNdRpUm38SWUrj0ccNDNSkwCD9qPA4KobLliG26yPppJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/demo.min.js" integrity="sha512-1WYc267IxoxmWXSOf4gXEEiyfgK041c8LYQQBnIl4EsvcR5T+x+nJ2f783U29u2QX7OzDTYI0nEyTZ05O8Y1jg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/pages/dashboard.min.js" integrity="sha512-wXkHJ2i8Z5fK/q6k7qe38qA6uD+VpLC/LL2XobX3rVVw6F3//fDWwoqMQ2Mgy5nf9BIvW2gLbILQJTIO/gDrDg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/pages/dashboard2.min.js" integrity="sha512-/On5eFU1vz1sGgejVpebEmg91zdKYXBcm4HPzDHcKOF1icilwxSR0C1ClBcK9IodnQdow2HjmHnqxt8PdQRrAA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/pages/dashboard3.min.js" integrity="sha512-l8RWdqTMUrIWPpdL2yB14+n+2WBPFe/KhH65aa3YAi+fRVvRMKxMVgmdk0/EUXLRKLFJmUH4rBABfxBsribrJg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>