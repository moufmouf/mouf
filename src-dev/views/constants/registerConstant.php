<?php
/*
 * This file is part of the Mouf core package.
 *
 * (c) 2012 David Negrier <david@mouf-php.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */
 
?>
<h1>Add/edit constant</h1>

<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery("#type").change(function() {
		if (jQuery("#type").val() == 'bool') {
			jQuery("#booldefaultvalue").show();
			jQuery("#booldefaultvalue").removeAttr("disabled");
			jQuery("#textdefaultvalue").hide();
			jQuery("#textdefaultvalue").attr("disabled", "true");
			jQuery("#boolvalue").show();
			jQuery("#boolvalue").removeAttr("disabled");
			jQuery("#textvalue").hide();
			jQuery("#textvalue").attr("disabled", "true");
		} else {
			jQuery("#booldefaultvalue").hide();
			jQuery("#booldefaultvalue").attr("disabled", "true");
			jQuery("#textdefaultvalue").show();
			jQuery("#textdefaultvalue").removeAttr("disabled");
			jQuery("#boolvalue").hide();
			jQuery("#boolvalue").attr("disabled", "true");
			jQuery("#textvalue").show();
			jQuery("#textvalue").removeAttr("disabled");
		}
	});

    var changePlaceHolder = function() {
        jQuery('input[name=envName]').attr('placeholder', jQuery('input[name=name]').val());
    };

    var switchEnvFields = function() {
        var fetchFromEnvVal = jQuery('select[name=fetchFromEnv]').val();
        if (fetchFromEnvVal == '0') {
            jQuery('.envSpecific').hide();
            jQuery('.constValueField').show();
        } else if (fetchFromEnvVal == '1') {
            jQuery('.envSpecific').show();
            jQuery('.constValueField').show();
        } else if (fetchFromEnvVal == '2') {
            jQuery('.envSpecific').show();
            jQuery('.constValueField').hide();
        }
    };

    changePlaceHolder();
    switchEnvFields();
    jQuery('input[name=name]').keyup(changePlaceHolder);
    jQuery('select[name=fetchFromEnv]').change(switchEnvFields);
});
</script>

<form action="registerConstant" method="post" class="form-horizontal">
<input type="hidden" name="selfedit" id="selfedit" value="<?php echo $this->selfedit; ?>" />
<?php 
if ($this->type == "bool") {
	$hideBool = "";
	$hideText = " style='display:none' disabled='true' ";
} else {
	$hideText = "";
	$hideBool = " style='display:none' disabled='true' ";
}

?>
<div class="control-group">
<label class="control-label">Name:</label>
<div class="controls">
	<input name="name" type="text" value="<?php echo plainstring_to_htmlprotected($this->name); ?>" placeholder="Constant name" />
</div>
</div>

<div class="control-group">
<label class="control-label">Type:</label>
<div class="controls">
<select id="type" name="type">
	<option value="string" <?php if ($this->type == "string") echo "selected='selected'"; ?>>String</option>
	<option value="float" <?php if ($this->type == "float") echo "selected='selected'"; ?>>Float</option>
	<option value="int" <?php if ($this->type == "int") echo "selected='selected'"; ?>>Integer</option>
	<option value="bool" <?php if ($this->type == "bool") echo "selected='selected'"; ?>>Boolean</option>
</select>
</div>
</div>

<div class="control-group">
    <label class="control-label">Fetch from environment variable:</label>
    <div class="controls">
        <select name="fetchFromEnv">
            <option value="0" <?php if ($this->fetchFromEnv == 0): ?>selected="selected"<?php endif ?>>No</option>
            <option value="1" <?php if ($this->fetchFromEnv == 1): ?>selected="selected"<?php endif ?>>Yes, fallback to config file</option>
            <option value="2" <?php if ($this->fetchFromEnv === 2): ?>selected="selected"<?php endif ?>>Yes, no fallback (environment variable MUST exist)</option>
        </select>
        <span class="help-block">Environment variables are used in priority over the stored configuration. Configuration is used as a fallback if environment variable is not set.</span>
    </div>
</div>

<div class="control-group envSpecific">
    <label class="control-label">Maps to environment variable:</label>
    <div class="controls">
        <input name="envName" type="text" value="<?php echo plainstring_to_htmlprotected($this->envName); ?>" placeholder="" />
        <span class="help-block">If empty, the name of the constant is used instead.</span>
    </div>
</div>

<div class="control-group constValueField">
<label class="control-label">Default value:</label>
<div class="controls">
	<input id="booldefaultvalue" <?php echo $hideBool ?> type="checkbox" name="defaultvalue" value="true" <?php echo $this->defaultvalue?"checked='checked'":""; ?> />
	<input id="textdefaultvalue" <?php echo $hideText ?> name="defaultvalue" type="text" value="<?php echo plainstring_to_htmlprotected($this->defaultvalue); ?>" />
</div>
</div>

<div class="control-group constValueField">
<label class="control-label">Value:</label>
<div class="controls">
	<input id="boolvalue" <?php echo $hideBool ?> type="checkbox" name="value" value="true" <?php echo $this->value?"checked='checked'":""; ?> />
	<input id="textvalue" <?php echo $hideText ?> name="value" type="text" value="<?php echo plainstring_to_htmlprotected($this->value); ?>" />
</div>
</div>

<div class="control-group">
<label class="control-label">Comments:</label>
<div class="controls">
	<textarea name="comment"><?php echo plainstring_to_htmlprotected($this->comment); ?></textarea>
</div>
</div>

<?php // Type ?>

<div class="control-group">
<div class="controls">
<button type="submit" class="btn btn-primary">Save</button>
<a href="." class="btn">Cancel</a>
</div>
</div>
</form>