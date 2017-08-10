<?php
exec(" convert -size 600x600 xc:none -fill red -stroke black  -font Candice -pointsize 90 -rotate 30 -gravity center -draw 'text 0,0 Hello' BearsText.png");
echo ('<img src="BearsText.png">');

?>