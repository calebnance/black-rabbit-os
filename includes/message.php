<?php
class Msg
{
	public static function alert($msg, $type)
	{
        if (!empty($msg)) {
            if (empty($type)) {
                $type = 'success';
            }
            ?>
            <div class="alert alert-<?php echo $type; ?>">
    			<button type="button" class="close" data-dismiss="alert">&times;</button>
    			<?php echo $msg; ?>
    		</div>
            <?php
        }
	}
}
?>
