<?php

include("config.php");
    session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") 
   {      
      
     $category = $_POST['category']; 
     $subcategory = $_POST['subcategory'];  

    if ($subcategory == '' || $subcategory == 'undefined' ) 
    {     
      $fulldirectory = dirname(__FILE__).'/img/clip_art/'.$category;
      $directory = 'img/clip_art/'.$category;
      $categories  = scandir($fulldirectory);   
      print_r('<table id="clipArtTable2" class="table table-fixed">');    
     
      $categories = array_diff($categories, array($category.'.png','.','..'));
      //print_r($categories);
      $categories = array_values($categories);  
      //print_r($categories);    
      //print_r(sort($categories));      
      print_r('<table id="clipArtTable2" class="table table-fixed">');
      print_r('<tbody>'); 

      if (count($categories) == 1) 
      {
            $valuetmp =  "'".$categories[0]."'";
            print_r('    <tr>') ;                    
            print_r('    <td height="80px" width="195px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
            //print_r('        <img art-image="" src="'.$directory.'/'. $categories[0].'/'.$categories[0].'.png" width="50" height="50"><br>') ;
            print_r('        <a href="javascript:void(0);" onclick="setSubCategory('.$valuetmp.');">'.'        <img art-image="" src="'.$directory.'/'. $categories[0].'/'.$categories[0].'.png" width="50" height="50"><br>'.str_replace('.png', '', $categories[0]).'</a>');
            print_r('    </td>') ;          
            print_r('    </tr>') ;
      }
      else if (count($categories) == 2) 
      {
            $valuetmp =  "'".$categories[1]."'";
            print_r('    <tr>') ;                    
            print_r('    <td height="80px" width="195px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
            //print_r('        <img art-image="" src="'.$directory.'/'. $categories[1].'/'.$categories[1].'.png" width="50" height="50"><br>') ;
            print_r('        <a href="javascript:void(0);" onclick="setSubCategory('.$valuetmp.');">'.'        <img art-image="" src="'.$directory.'/'. $categories[1].'/'.$categories[1].'.png" width="50" height="50"><br>'.str_replace('.png', '', $categories[1]).'</a>');
            print_r('    </td>') ; 
            $valuetmp =  "'".$categories[0]."'";
            print_r('    <td height="80px" width="195px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
            //print_r('        <img art-image="" src="'.$directory.'/'. $categories[0].'/'.$categories[0].'.png" width="50" height="50"><br>') ;
            print_r('        <a  href="javascript:void(0);"onclick="setSubCategory('.$valuetmp.');">'.'        <img art-image="" src="'.$directory.'/'. $categories[0].'/'.$categories[0].'.png" width="50" height="50"><br>'.str_replace('.png', '', $categories[0]).'</a>');
            print_r('    </td>') ;          
            print_r('    </tr>') ;
      }
      else
      {
       
        if (count($categories)  % 2 == 0)
        {
          //print_r($categories);
          for ($i=0; $i< count($categories) ; $i+=2) 
          {             
              $valuetmp =  "'".$categories[$i]."'";
              print_r('    <tr>') ;                    
              print_r('    <td height="80px" width="195px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
              //print_r('        <img art-image="" src="'.$directory.'/'. $categories[$i].'/'.$categories[$i].'.png" width="50" height="50"><br>') ;
              print_r('        <a href="javascript:void(0);" onclick="setSubCategory('.$valuetmp.');">'.'        <img art-image="" src="'.$directory.'/'. $categories[$i].'/'.$categories[$i].'.png" width="50" height="50"><br>'.str_replace('.png', '', $categories[$i]).'</a>');
              print_r('    </td>') ; 
                $valuetmp =  "'".$categories[$i+1]."'";
              print_r('    <td height="80px" width="195px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
              //print_r('        <img art-image="" src="'.$directory.'/'. $categories[$i+1].'/'.$categories[$i+1].'.png" width="50" height="50"><br>') ;
              print_r('        <a  href="javascript:void(0);"onclick="setSubCategory('.$valuetmp.');">'.'        <img art-image="" src="'.$directory.'/'. $categories[$i+1].'/'.$categories[$i+1].'.png" width="50" height="50"><br>'.str_replace('.png', '', $categories[$i+1]).'</a>');
              print_r('    </td>') ;          
              print_r('    </tr>') ; 
          }
        }
        else
        {          

          for ($i=0; $i< count($categories)-1 ; $i+=2) 
          { 
               $valuetmp =  "'".$categories[$i]."'";
              print_r('    <tr>') ;                    
              print_r('    <td height="80px" width="195px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
              //print_r('        <img art-image="" src="'.$directory.'/'. $categories[$i].'/'.$categories[$i].'.png" width="50" height="50"><br>') ;
              print_r('        <a  href="javascript:void(0);"onclick="setSubCategory('.$valuetmp.');">'.'        <img art-image="" src="'.$directory.'/'. $categories[$i].'/'.$categories[$i].'.png" width="50" height="50"><br>'.str_replace('.png', '', $categories[$i]).'</a>');
              print_r('    </td>') ; 
                $valuetmp =  "'".$categories[$i+1]."'";
              print_r('    <td height="80px" width="195px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
              //print_r('        <img art-image="" src="'.$directory.'/'. $categories[$i+1].'/'.$categories[$i+1].'.png" width="50" height="50"><br>') ;
              print_r('        <a  href="javascript:void(0);"onclick="setSubCategory('.$valuetmp.');">'.'        <img art-image="" src="'.$directory.'/'. $categories[$i+1].'/'.$categories[$i+1].'.png" width="50" height="50"><br>'.str_replace('.png', '', $categories[$i+1]).'</a>');
              print_r('    </td>') ;          
              print_r('    </tr>') ; 
          }
            $valuetmp =  "'".$categories[count($categories)-1]."'";
            print_r('    <tr>') ;                    
            print_r('    <td height="80px" width="195px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
            //print_r('        <img art-image="" src="'.$directory.'/'. $categories[count($categories)-1].'/'.$categories[count($categories)-1].'.png" width="50" height="50"><br>') ;
            print_r('        <a  href="javascript:void(0);"onclick="setSubCategory('.$valuetmp.');">'.'        <img art-image="" src="'.$directory.'/'. $categories[count($categories)-1].'/'.$categories[count($categories)-1].'.png" width="50" height="50"><br>'.str_replace('.png', '', $categories[count($categories)-1]).'</a>');
            print_r('    </td>') ;          
            print_r('    </tr>') ;

        }
      }
      print_r('</tbody>');
      print_r('</table>');
    }
    else
    {
      $fulldirectory = dirname(__FILE__).'/img/clip_art/'.$category.'/'.$subcategory;
      $directory = 'img/clip_art/'.$category; 
      $categories  = scandir($fulldirectory);
      print_r('<table id="clipArtTable2" class="table table-fixed">');
      print_r('<tbody>');
      if ((count($categories)-2) == 1) 
      {
           print_r('    <tr>') ;                    
            print_r('    <td height="110px" width="110px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
            print_r('<img class="hover" src="'.$directory.'/'.$subcategory.'/'.str_replace('.png', '', $categories[count($categories)-1]).'.png" style="max-width:110px; max-height:110px;" onclick="addImg(this);">') ;
            print_r('    </td>') ;         
            print_r('    </tr>') ;
      }
      else if ((count($categories)-2) == 2) 
      {
            print_r('    <tr>') ;                    
            print_r('    <td height="110px" width="110px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
            print_r('<img class="hover" src="'.$directory.'/'.$subcategory.'/'.str_replace('.png', '', $categories[count($categories)-2]).'.png" style="max-width:110px; max-height:110px;" onclick="addImg(this);">') ;
            print_r('    </td>') ; 
            print_r('    <td height="110px" width="110px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
            print_r('<img class="hover" src="'.$directory.'/'.$subcategory.'/'.str_replace('.png', '', $categories[count($categories)-1]).'.png" style="max-width:110px; max-height:110px;" onclick="addImg(this);">') ;
            print_r('    </td>') ;         
            print_r('    </tr>') ;
      }
      else
      {
        if ((count($categories)-2)  % 3 == 0)
        {
            for ($i=2; $i< count($categories) ; $i+=3) 
            { 
              
                print_r('    <tr>') ;                    
                  print_r('    <td height="110px" width="110px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
                  print_r('<img class="hover" src="'.$directory.'/'.$subcategory.'/'.str_replace('.png', '', $categories[$i]).'.png" style="max-width:110px; max-height:110px;" onclick="addImg(this);">') ;
                  print_r('    </td>') ;    
                  print_r('    <td height="110px" width="110px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
                  print_r('<img class="hover" src="'.$directory.'/'.$subcategory.'/'.str_replace('.png', '', $categories[$i+1]).'.png" style="max-width:110px; max-height:110px;" onclick="addImg(this);">') ;
                  print_r('    </td>') ;
                  print_r('    <td height="110px" width="110px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
                  print_r('<img class="hover" src="'.$directory.'/'.$subcategory.'/'.str_replace('.png', '', $categories[$i+2]).'.png" style="max-width:110px; max-height:110px;" onclick="addImg(this);">') ;
                  print_r('    </td>') ;                                
                print_r('    </tr>') ;      
            }
        }
        if ((count($categories)-2)  %3 == 1)
        {
            for ($i=2; $i< count($categories) - 1 ; $i+=3) 
            { 
              
                print_r('    <tr>') ;                    
                  print_r('    <td height="110px" width="110px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
                  print_r('<img class="hover" src="'.$directory.'/'.$subcategory.'/'.str_replace('.png', '', $categories[$i]).'.png" style="max-width:110px; max-height:110px;" onclick="addImg(this);">') ;
                  print_r('    </td>') ;    
                  print_r('    <td height="110px" width="110px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
                  print_r('<img class="hover" src="'.$directory.'/'.$subcategory.'/'.str_replace('.png', '', $categories[$i+1]).'.png" style="max-width:110px; max-height:110px;" onclick="addImg(this);">') ;
                  print_r('    </td>') ;
                  print_r('    <td height="110px" width="110px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
                  print_r('<img class="hover" src="'.$directory.'/'.$subcategory.'/'.str_replace('.png', '', $categories[$i+2]).'.png" style="max-width:110px; max-height:110px;" onclick="addImg(this);">') ;
                  print_r('    </td>') ;                                
                print_r('    </tr>') ;      
            }

            print_r('    <tr>') ;                    
            print_r('    <td height="110px" width="110px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
            print_r('<img class="hover" src="'.$directory.'/'.$subcategory.'/'.str_replace('.png', '', $categories[count($categories)-1]).'.png" style="max-width:110px; max-height:110px;" onclick="addImg(this);">') ;
            print_r('    </td>') ;         
            print_r('    </tr>') ;
        }
        if ((count($categories)-2)  %3 == 2)
        {
            for ($i=2; $i< count($categories) - 2 ; $i+=3) 
            { 
              
                print_r('    <tr>') ;                    
                  print_r('    <td height="110px" width="110px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
                  print_r('<img class="hover" src="'.$directory.'/'.$subcategory.'/'.str_replace('.png', '', $categories[$i]).'.png" style="max-width:110px; max-height:110px;" onclick="addImg(this);">') ;
                  print_r('    </td>') ;    
                  print_r('    <td height="110px" width="110px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
                  print_r('<img class="hover" src="'.$directory.'/'.$subcategory.'/'.str_replace('.png', '', $categories[$i+1]).'.png" style="max-width:110px; max-height:110px;" onclick="addImg(this);">') ;
                  print_r('    </td>') ;
                  print_r('    <td height="110px" width="110px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
                  print_r('<img class="hover" src="'.$directory.'/'.$subcategory.'/'.str_replace('.png', '', $categories[$i+2]).'.png" style="max-width:110px; max-height:110px;" onclick="addImg(this);">') ;
                  print_r('    </td>') ;                                
                print_r('    </tr>') ;      
            }

            print_r('    <tr>') ;                    
            print_r('    <td height="110px" width="110px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
            print_r('<img class="hover" src="'.$directory.'/'.$subcategory.'/'.str_replace('.png', '', $categories[count($categories)-2]).'.png" style="max-width:110px; max-height:110px;" onclick="addImg(this);">') ;
            print_r('    </td>') ; 
            print_r('    <td height="110px" width="110px" align="center" style="border-left:none;border-bottom:none;border-top:none" style="cursor:pointer">') ;
            print_r('<img class="hover" src="'.$directory.'/'.$subcategory.'/'.str_replace('.png', '', $categories[count($categories)-1]).'.png" style="max-width:110px; max-height:110px;" onclick="addImg(this);">') ;
            print_r('    </td>') ;         
            print_r('    </tr>') ;
      }
  }

        

     
      print_r('</tbody>');  
      print_r('</table>');

    }   
  }  
?>