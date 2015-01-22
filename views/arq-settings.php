<?php if (!defined('APPLICATION')) exit(); 
echo $this->Form->Open();
echo $this->Form->Errors();
?>

<h1><?php echo T('Add Registration Question / by Peregrine'); ?></h1>

<table class="AltRows">
    <tbody>
        <?php
        echo"<tr><td>";
        echo T("Enter Your Label or Question:");
        echo "</td><td>";
        echo $this->Form->TextBox('Plugins.AddRegistrationQuestion.Label', array('class' => 'QInput', 'size' => "80"));
        echo "</td><tr><td>";
        echo T("Enter the code or answer:");
        echo "</td><td>";
        echo $this->Form->TextBox('Plugins.AddRegistrationQuestion.SecretCode');
        echo "</td>";

        echo "</tr>";
        ?>
    </tbody>
</table>
<br />

<?php echo $this->Form->Close('Submit'); ?>
