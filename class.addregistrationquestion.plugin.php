<?php

$PluginInfo['AddRegistrationQuestion'] = [
    'Name' => 'Add Registration Question',
    'Description' => 'Allows you to add a question to the registration form to deflect spam bots.',
    'Version' => '2.0',
    'Author' => 'Peregrine',
    'MobileFriendly' => true,
    'SettingsUrl' => 'settings/addregistrationquestion',
    'SettingsPermission' => 'Garden.Settings.Manage',
    'License' => 'GNU GPL2'
];

class AddRegistrationQuestion extends Gdn_Plugin {

    public function gdn_dispatcher_appStartup_handler() {
        if (c('AddRegistrationQuestion.Basic')) {
            saveToConfig('Garden.Registration.Method', 'Basic', false);
        }
    }


    public function entryController_registerFormBeforeTerms_handler($sender) {
        echo wrap($sender->Form->label($this->question(), 'Question').$sender->Form->textBox('Question'), 'li');
    }


    public function entryController_registerValidation_handler($sender) {
        if (strcasecmp($sender->Form->getValue('Question'), $this->answer()) !== 0) {
            $sender->Form->addError('The security question was answered incorrectly.');
            $sender->render();
            exit();
        }
    }


    public function settingsController_addRegistrationQuestion_create($sender) {
        $sender->permission('Garden.Settings.Manage');
        $sender->addSideMenu();
        $conf = new ConfigurationModule($sender);
        $conf->initialize([
            'AddRegistrationQuestion.Question' => [
                'Control' => 'textbox',
                'LabelCode' => 'Question',
                'Description' => 'Do not use the default question and change this from time to time for best results.',
                'Default' => $this->question()
            ],
            'AddRegistrationQuestion.Answer' => [
                'Control' => 'textbox',
                'LabelCode' => 'Answer',
                'Description' => 'Note: The check for the correct answer is case-insensitive.',
                'Default' => $this->answer()
            ],
            'AddRegistrationQuestion.Basic' => [
                'Control' => 'checkbox',
                'LabelCode' => 'Use this as the only form of registration validation'
            ]
        ]);
        $sender->title('Registration Question');
        $conf->renderAll();
    }


    private function question() {
        return t(c('AddRegistrationQuestion.Question', 'Are you a bot?'));
    }


    private function answer() {
        return t(c('AddRegistrationQuestion.Answer', 'no'));
    }

}
