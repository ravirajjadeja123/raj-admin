<?php include("linkvars.php"); ?><div id="sidebar" class="sidebar-fixed">    <!-- Start : Side bar -->

            <div id="sidebar-content">  <!-- Start : Side bar content -->
                
                <ul id="nav">   <!-- Start : Side bar Menu Items -->
                    
                    <li class="current open">
                        <a href="deskboard.php">
                            <i class="fa fa-dashboard"></i> Dashboard <span class="selected"></span>
                        </a>
                    </li>
                    <?php
                      for($i=0;$i<count($HeadLinksArray);$i++)
                      {
                    ?>
                        <li>

                              <a href="<?php echo ($HeadLinksArray[$i][2]>0)?'javascript:void(0);':$HeadLinksArray[$i][4]; ?>">
                                   <i class="<?php echo ($HeadLinksArray[$i][1]=='')?'':$HeadLinksArray[$i][1]; ?>"></i>
                                   <?php echo $HeadLinksArray[$i][0]; ?>
                              </a>
                              <?php if($HeadLinksArray[$i][2]>0)
                              {
                                ?>
                              <ul class="sub-menu">
          <?php
                  $LeftLinkAry1 = $HeadLinksArray[$i][3];
                  for($LeftLinkCount=0;$LeftLinkCount<count($LeftLinkAry1);$LeftLinkCount++)
                  {
                  ?>
                  <li>
                       <a href="<?php echo $LeftLinkAry1[$LeftLinkCount][2]; ?>">
                                <i class="<?php echo ($LeftLinkAry1[$LeftLinkCount][1]=='')?'fa fa-desktop':$LeftLinkAry1[$LeftLinkCount][1]; ?>"></i><?php echo $LeftLinkAry1[$LeftLinkCount][0]; ?>
                                </a>
                  </li>  

                  <?php          
                  }
             ?>
                               </ul>
                            <?php
                              }
                              ?>
                        </li>
                    <?php
                      }
                    ?>

                </ul>   <!-- End : Side bar Menu Items -->
                
            </div>  <!-- End : Side bar content -->

        </div>  <!-- End : Side bar -->