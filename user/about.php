<?php include "../autoload/autoload.php";
   $sql = "SELECT * FROM about WHERE status = 1";
   $sql_status = $db->fetchsql($sql);
   $data = [];
   foreach($sql_status as $item)
   {
      $statusid = intval($item['id']);
      $sqlstatus = "SELECT * FROM about WHERE id = $statusid";
      $aboutstatus = $db -> fetchsql($sqlstatus);
      $data[$item['title']] = $aboutstatus;
   }
 ?>
<?php include "../layouts/header2.php" ?>
   <div class="col-md-15">
   <?php foreach($data as $key => $value): ?>
      <div class="col-md-12">      
            <div class="col-md-6 about ">                              
               <h1><?php echo $key ?></h1>                 
               <?php foreach($value as $item): ?>
               <p><?php echo $item['content'] ?></p>
            </div>
            <div class="col-md-6 bor detail ">
                  <img src="<?php echo upload() ?>about/<?php echo $item['img'] ?>" alt="" class="img-thumbnail img-fluid">
            </div>
               <?php endforeach ?>    
      </div>
   <?php endforeach ?>
   </div>
</div>
<?php include "../layouts/footer.php" ?>        