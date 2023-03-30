<!DOCTYPE html>
<html lang="en">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VBI | <?= $judul ?></title>

    <!-- logo Samping Website -->
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">

    <!-- Ionic CSS -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <!-- Select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/jqvmap/jqvmap.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/dist/css/adminlte.min.css?v=3.2.0">

    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/summernote/summernote-bs4.min.css">

    <!-- Datatable CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <script nonce="2df592d9-aa54-4131-a020-23e1aab1b775">
        (function(w, d) {
            ! function(Z, _, ba, bb) {
                Z.zarazData = Z.zarazData || {};
                Z.zarazData.executed = [];
                Z.zaraz = {
                    deferred: [],
                    listeners: []
                };
                Z.zaraz.q = [];
                Z.zaraz._f = function(bc) {
                    return function() {
                        var bd = Array.prototype.slice.call(arguments);
                        Z.zaraz.q.push({
                            m: bc,
                            a: bd
                        })
                    }
                };
                for (const be of ["track", "set", "debug"]) Z.zaraz[be] = Z.zaraz._f(be);
                Z.zaraz.init = () => {
                    var bf = _.getElementsByTagName(bb)[0],
                        bg = _.createElement(bb),
                        bh = _.getElementsByTagName("title")[0];
                    bh && (Z.zarazData.t = _.getElementsByTagName("title")[0].text);
                    Z.zarazData.x = Math.random();
                    Z.zarazData.w = Z.screen.width;
                    Z.zarazData.h = Z.screen.height;
                    Z.zarazData.j = Z.innerHeight;
                    Z.zarazData.e = Z.innerWidth;
                    Z.zarazData.l = Z.location.href;
                    Z.zarazData.r = _.referrer;
                    Z.zarazData.k = Z.screen.colorDepth;
                    Z.zarazData.n = _.characterSet;
                    Z.zarazData.o = (new Date).getTimezoneOffset();
                    Z.zarazData.q = [];
                    for (; Z.zaraz.q.length;) {
                        const bl = Z.zaraz.q.shift();
                        Z.zarazData.q.push(bl)
                    }
                    bg.defer = !0;
                    for (const bm of [localStorage, sessionStorage]) Object.keys(bm || {}).filter((bo => bo.startsWith("_zaraz_"))).forEach((bn => {
                        try {
                            Z.zarazData["z_" + bn.slice(7)] = JSON.parse(bm.getItem(bn))
                        } catch {
                            Z.zarazData["z_" + bn.slice(7)] = bm.getItem(bn)
                        }
                    }));
                    bg.referrerPolicy = "origin";
                    bg.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(Z.zarazData)));
                    bf.parentNode.insertBefore(bg, bf)
                };
                ["complete", "interactive"].includes(_.readyState) ? zaraz.init() : Z.addEventListener("DOMContentLoaded", zaraz.init)
            }(w, d, 0, "script");
        })(window, document);
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url('assets/img/logo1.png') ?>" alt="Logo Perusahaan" height="60" width="60">
        </div>