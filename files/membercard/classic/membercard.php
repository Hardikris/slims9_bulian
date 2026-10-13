<?php
function floatvalue($val){
  $val = str_replace(",",".",$val);
  $val = preg_replace('/\.(?=.*\.)/', '', $val);
  return floatval($val);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Document</title>
<style>
<?php
$card_path = str_replace("\\", "/", $card_path);
?>
@font-face {
  font-family: "Quicksand";
  src: url('<?php echo $card_path ?>fonts/Quicksand/Quicksand-Regular.ttf') format('truetype');
  font-weight: 400;
  font-style: normal;
}
@font-face {
  font-family: "Quicksand";
  src: url('<?php echo $card_path ?>fonts/Quicksand/Quicksand-Bold.ttf') format('truetype');
  font-weight: 700;
  font-style: bold;
}

body {
  font: 7pt/1.4 'Quicksand', sans-serif;
  color:<?php echo $sysconf['print']['membercard']['f_color']??'#000';  ?>;  ;
}

p,
h1,
strong {
  margin:0;
  padding:0;
}

.personality {
  flex: 0cm      
}
.personality div {
  flex-direction: column;
}

#front-card,
#back-card {
  width: <?= round($sysconf['print']['membercard']['box_width']*$sysconf['print']['membercard']['factor']); ?>px;
  height: <?= round($sysconf['print']['membercard']['box_height']*$sysconf['print']['membercard']['factor']); ?>px;
  border: solid 1px #e4e4e4;
  position: relative;
}

#front-card {
  background-color: <?php echo $sysconf['print']['membercard']['fr_color']??'#E5E5E5';  ?>;    
}

#front-card header {
  padding: 15px 10px 5px 10px;
  background-color: #fff;
  text-transform: uppercase;
  color: <?php echo $sysconf['print']['membercard']['header_font_color']??'#000'; ?> !important;  
}

#front-card header .brand {
  font-size: 9pt;
  font-weight: bold;
}

#front-card header .sub-brand {
  font-size: 7pt;
}

#front-card header .brand,
#front-card header .sub-brand {
  padding-left: 60px;
}

#front-card .logo img {
  position: absolute;
  top: 6px;
}

.identity {
  padding-left: 5px;
  padding-bottom: 5px;
}

.identity h3 {
  height: 15px;
  padding-left: 5px;
  text-transform: uppercase;
}

.personality {      
  display: flex;
  margin-top: 1px;
  margin-bottom: 0;
}

#front-card .address {
  width: 200px;
}

.personality .noid {
  position: relative;
}

.personality .noid:after {
  position: absolute;
  content: '';
  border-right: solid 1px #000;
  height: 25px;
  top: 0;
  right: 0;
}

.personality .nophone {
  padding-left: 5px;
}

.personality .noid strong,
.personality .nophone strong {
  white-space: nowrap; 
}
.personality .expired {
  margin-top: -10px;
}

.personality strong {      
  margin:0;
  line-height: 0;
}

.code {
  position: absolute;
  right: 10px;
  bottom: 5px;
}

.barcode {
  text-align: center;
  margin:0;
  height: 50px;
  overflow: hidden;
  width: 200px;
  border-top: solid 2px #fff;
  border-bottom: solid 2px #fff;
}

.barcode img {
  margin:0;
  width: <?php echo $sysconf['print']['membercard']['barcode_scale'] ?>%;
}

.librarian,
.position {
  font-weight: bold;
}

.print_btn {
  background: #333;
  padding: 10px 15px;
  text-decoration: none;
  color: #fff;
  margin-bottom: 5px;
  display: inline-block;
}

@media print {
  .print_btn {
    display: none;
  }  
}
</style>
</head>
<body>
<a class="print_btn" href="#" onclick="window.print()"><?php echo __('Print Again') ?></a>
<table cellpadding="0" cellspacing="0">
  <?php foreach ($chunked_card_arrays as $membercard_rows) : ?>
  <tr>
    <?php foreach ($membercard_rows as $card) : ?>
    <td>
    <div>
    <!-- Frontcard -->
    <section id="front-card">
      <header>
        <div class="logo">
          <img src="<?php echo $card_logo ?>" alt="No Photo">
          <div class="sub-brand"><?php echo $sysconf['print']['membercard']['front_header1_text'] ?></div>
          <div class="brand"><?php echo $sysconf['print']['membercard']['front_header2_text'] ?></div>
        </div>
      </header>
      <main>
        <div class="identity">
          <h3><?php echo $card['member_name'] ?></h3>
          <div class="personality">
            <div class="nophone">
              <strong><?php echo __('Member ID') ?></strong>
              <p><?php echo $card['member_id'] ?></p>
              <strong><?php echo __('Expired') ?></strong>
              <p><?php echo $card['expire_date'] ?></p>
            </div>
            <div class="code">
              <div class="barcode">
                <img src="<?php echo SWB.IMG.'/barcodes/'.str_replace(array(' '), '_', $card['member_id']) ?>.png" alt="No  Barcode">
              </div>
            </div>
          </div>
        </div>
      </main>
    </section>
    <!-- End Frontcard -->
    </td>
    <?php endforeach ?>
  </tr>
  <?php endforeach ?>
</table>

<script type="text/javascript">
  self.print();
</script>

</body>
</html>