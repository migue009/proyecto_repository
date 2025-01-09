<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elegant Dashboard | Dashboard</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="../img/svg/Logo.svg" type="image/x-icon">
  <!-- Custom styles -->
  <link rel="stylesheet" href="../css/style.min.css">
  <!-- sweetalert -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css">
  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/plugins.min.css" />
  <link rel="stylesheet" href="assets/css/demo.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../mapa/misc/img/dc.css">
  
  <script src="../mapa/misc/lib/mscross-1.1.9.js" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="assets/js/plugin/webfont/webfont.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
  </script>
  <style>
  
  .container .container.map-container{
    overflow-y:hidden !important;
  }
  #Layer1{
    width:162px !important;
    height:158px !important;
    z-index:101 !important;
    left:751px !important; 
    top:26px !important;
  }
      
  #Layer2{
      width:141px !important;
      height:315px !important;
      z-index:102 !important;
      left:751px !important;
      top:216px !important;
      padding: 20px !important;
      border-radius: 50px !important; 
      background-color: #E1E8ED !important;
  }

  #dc_main {
    border: 5px solid rgba(0, 17, 255, 0.7) !important; 
    border-radius:10px;
    overflow: hidden !important;
    width: 900px !important;
    height: 400px !important;
    position: relative !important;
  }

  #dc_main img {
      border: none !important; 
      opacity: 1.2 !important; 
      position: relative !important;

  }
  #dc_main.mscross div div{
    left: 0px !important;
    height: 400px !important;
  }
  #dc_main.mscross div img{
    height:400px !important;
    width:900px !important;
  }
  #dc_main.mscross div img.mscross_tool{
    height:30px !important;
    width:30px !important;
    border-radius: 50px !important;
    border: 4px solid rgba(0, 17, 255, 0.5) !important;
    padding:0px !important;
    left: 5px !important;
  }


  .mscross_tool {
      background-color: rgba(0, 0, 0, 0.5) !important; 
      border-radius: 5px !important;
      position: absolute !important;
  }


  #dc_main2.mscross div img{
    z-index: 0!important;
    width: 100px !important;
    height: 100px !important; 
    border: 0px none !important;
    margin: 0px !important;
    padding: 0px !important;
    position: absolute !important;
    top: 0px;
    left: 0px;
  }
 
  #dc_main2.mscross .mscross_reference_zoombox{
    background-color: rgb(119, 119, 119) !important; 
    opacity: 0.5 !important
}
  #dc_main2 {
    border: 5px solid rgba(0, 17, 255, 0.7) !important; 
    border-radius:10px;
  }
  #dc_main2 div {
    position: relative !important;
  }

  #dc_main img.mscross_tool{
    position: relative !important;
    left: 465px !important;
    padding: 0px !important;
    display: block !important;
  }
  </style>
</head>
