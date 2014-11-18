<?php $id = $row['serviceId'] ?>
<div id="<?php echo $id; ?>" class="modform">
    <label for="modUsername<?php echo $id; ?>">User: </label>
    <input type="text" id="modUsername<?php echo $id; ?>" value="<?php echo sanitizeHtmlString($row['username']);?>" />
    <br />
    <label for="modPassword<?php echo $id; ?>">Pass: </label>
    <input type="text" id="modPassword<?php echo $id; ?>" value="<?php echo sanitizeHtmlString($row['password']);?>" />
    <br />
    <button class="modSubmit" onclick="submitPasswordChange(<?php echo $id; ?>,$('#modUsername<?php echo $id; ?>').val(),$('#modPassword<?php echo $id; ?>').val())">Change</button>
    <a class="modHide" href="#" onclick="hideModForm(<?php echo $id; ?>);">Hide</a>
</div>