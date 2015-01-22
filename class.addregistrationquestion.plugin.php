<?php if (!defined('APPLICATION')) exit();

$PluginInfo['AddRegistrationQuestion'] = array(
    'Name' => 'Add Registration Question',
    'Description' => 'Allows you to add a question to validate users during registration process to aid in stopping spam or bot registrants.',
    'Version' => '1.4',
    'Author' => "Peregrine",
    'MobileFriendly' => TRUE,
    'SettingsUrl' => '/dashboard/settings/addregistrationquestion',
);

class AddRegistrationQuestion extends Gdn_Plugin {

    public function EntryController_RegisterFormBeforeTerms_Handler($Sender) {
        $this->AddQuestion($Sender);
    }

    public function EntryController_RegisterBeforeTerms_Handler($Sender) {
        $this->AddQuestion($Sender);
    }

    public function AddQuestion($Sender) {
        echo "<li>";
        echo $Sender->Form->Label(C('Plugins.AddRegistrationQuestion.Label','Enter your secret code'), 'SecretCode');
        echo $Sender->Form->TextBox('SecretCode');
        echo "</li>";

        if ($correctanswer == "N") {
            $Sender->Validation->AddValidationResult('Secretcode', T('Please re-read all questions again and answer again'));
            $Sender->EventArguments['Valid'] = FALSE;
        }
    }

    public function EntryController_RegisterValidation_Handler($Sender) {
        $FormValues = $Sender->Form->FormValues();

        $UserCode = $FormValues['SecretCode'];

        $DefaultSecretCode = "Abc123";
        $SecretCode = (C('Plugins.AddRegistrationQuestion.SecretCode', $DefaultSecretCode));

        if (strtolower($UserCode) != strtolower($SecretCode)) {

            $Sender->Form->AddError('Please enter Correct Code.');
            $Sender->Render();
            exit();
        }
    }

    public function SettingsController_AddRegistrationQuestion_Create($Sender) {
        $Sender->Permission('Garden.Settings.Manage');
        $Sender->Form = new Gdn_Form();
        $Validation = new Gdn_Validation();
        $ConfigurationModel = new Gdn_ConfigurationModel($Validation);
        $ConfigurationModel->SetField(array(
            'Plugins.AddRegistrationQuestion.SecretCode',
            'Plugins.AddRegistrationQuestion.Label'
        ));
        $Sender->Form->SetModel($ConfigurationModel);
        $Sender->Title('Add Registration Question Plugin Settings');
        $Sender->AddSideMenu('settings/AddRegistrationQuestion');

        if ($Sender->Form->AuthenticatedPostBack() === FALSE) {
            $Sender->Form->SetData($ConfigurationModel->Data);
        } else {
            $Data = $Sender->Form->FormValues();
            if ($Sender->Form->Save() !== FALSE)
                $Sender->StatusMessage = T("Your settings have been saved.");
        }
        $Sender->Render($this->GetView('arq-settings.php'));
    }

    public function Setup() {
        SaveToConfig('Plugins.AddRegistrationQuestion.SecretCode', "PeregrineWasHere123");
        SaveToConfig('Plugins.AddRegistrationQuestion.Label', "Enter Your code");
    }

}
