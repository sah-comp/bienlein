<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @author $Author$
 * @version $Id$
 */

/**
 * Install controller.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Install extends Controller
{
    /**
     * DANGER MOUSE! DANGER MOUSE! THIS CAN KILL YOUR DATABASE AT ONCE!!!
     * 
     * Displays a install page if not already installed.
     *
     * To determine if the install proccess is needed we simply check if there is already
     * a admin user account. If so that user is notified.
     *
     * On a POST request, given a valid install pass phrase the install proccess is run
     * and on success the new admin gets a notification and a redirect to the admin page.
     */
    public function index()
    {
        if ($user = R::findOne('user', ' isadmin = ?', array(true))) $this->redirect('/admin');
        $user = R::dispense('user');
        if (Flight::request()->method == 'POST' && 
                password_verify(Flight::request()->data->pass, CINNEBAR_INSTALL_PASS)) {
            try {
                R::nuke();
                $this->makeDatabase();
                $this->initialFillings();
                $user = R::graph(Flight::request()->data->dialog, true);
                R::store($user);
                $user->notify(I18n::__('app_install_success'), 'success');
                $this->redirect('/admin');
            }
            catch (Exception $e) {
                error_log($e);
                //we failed to install, why?
            }
            
        }
        // either no yet submitted or the credentials given failed
        Flight::render('install/index_'.Flight::get('language'), array(
            'record' => $user
        ), 'content');
        Flight::render('html5', array(
            'title' => I18n::__('install_head_title'),
            'language' => Flight::get('language')
        ));
    }
    
    /**
     * Installs the inital database if not already done so.
     *
     * @throws Exception Exception_Install when the install.sql file is missing
     */
    protected function makeDatabase()
    {
        if ( ! $queries = $this->getQueriesFromSQLFile(__DIR__ . '/../../app/res/db/install.sql')) {
            throw new Exception_Install(__DIR__ . '/../../app/res/db/install.sql is missing');
        }
        foreach ($queries as $query) {
            R::exec($query);
        }
        return true;
    }
    
    /**
     * Add initially needed tokens and translations.
     *
     * @return void
     */
    protected function initialFillings()
    {
        //action
        $actions = R::dispense('action', 4);
        $actions[0]->name = 'add';
        $actions[1]->name = 'edit';
        $actions[2]->name = 'index';
        $actions[3]->name = 'expunge';
        R::storeAll($actions);
        //country
        $countries = R::dispense('country', 2);
        $countries[0]->iso = 'de';
        $countries[0]->name = 'Germany';
        $countries[0]->enabled = true;
        $countries[1]->iso = 'gb';
        $countries[1]->name = 'United Kingdom';
        $countries[1]->enabled = false;
        R::storeAll($countries);
        //domain
        $domains = R::dispense('domain', 8);
        $domains[0]->name = 'action';
        $domains[1]->name = 'domain';
        $domains[2]->name = 'language';
        $domains[3]->name = 'country';
        $domains[4]->name = 'user';
        $domains[5]->name = 'role';
        $domains[6]->name = 'team';
        $domains[7]->name = 'token';
        R::storeAll($domains);
        //language
        $languages = R::dispense('language', 3);
        $languages[0]->iso = 'de';
        $languages[0]->name = 'Deutsch';
        $languages[0]->enabled = true;
        $languages[1]->iso = 'en';
        $languages[1]->name = 'English';
        $languages[1]->enabled = false;
        $languages[2]->iso = 'us';
        $languages[2]->name = 'US-English';
        $languages[2]->enabled = false;
        R::storeAll($languages);
        //role
        $roles = R::dispense('role', 2);
        $roles[0]->name = 'Admin';
        $roles[1]->name = 'User';
        R::storeAll($roles);
        //team
        $team = R::dispense('team');
        $team->name = 'Development';
        R::store($team);
        //token
        //10
        I18n::make('account_logout_nav', array(
            'de' => 'Abmelden',
            'en' => 'Logout',
            'us' => 'Logout'
        ));
        I18n::make('action_add_nav', array(
            'de' => 'Hinzufügen',
            'en' => 'Add',
            'us' => 'Add'
        ));
        I18n::make('action_add_select', array(
            'de' => 'Sichern und mehr hinzufügen',
            'en' => 'Save and continue adding',
            'us' => 'Save and continue adding'
        ));
        I18n::make('action_edit_select', array(
            'de' => 'Sichern und bearbeiten',
            'en' => 'Save and edit',
            'us' => 'Save and edit'
        ));
        I18n::make('action_expunge_select', array(
            'de' => 'Löschen',
            'en' => 'Delete',
            'us' => 'Delete'
        ));
        I18n::make('action_h1', array(
            'de' => 'Aktionen',
            'en' => 'Actions',
            'us' => 'Actions'
        ));
        I18n::make('action_idle_select', array(
            'de' => 'Auf alle markierten&hellip;',
            'en' => 'All marked&hellip;',
            'us' => 'All marked&hellip;'
        ));
        I18n::make('action_index_select', array(
            'de' => 'Sichern und auflisten',
            'en' => 'Save and show list',
            'us' => 'Save and show list'
        ));
        I18n::make('action_label_name', array(
            'de' => 'Bezeichnung',
            'en' => 'Name',
            'us' => 'Name'
        ));
        I18n::make('action_legend', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        //20
        I18n::make('action_list_nav', array(
            'de' => 'Liste',
            'en' => 'List',
            'us' => 'List'
        ));
        I18n::make('action_next_edit_select', array(
            'de' => 'Sichern und nächsten bearbeiten',
            'en' => 'Save and edit next',
            'us' => 'Save and edit next'
        ));
        I18n::make('action_placeholder_name', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('action_prev_edit_select', array(
            'de' => 'Sichern und vorigen bearbeiten',
            'en' => 'Save and edit previous',
            'us' => 'Save and edit previous'
        ));
        I18n::make('admin_h1', array(
            'de' => 'Einstellungen',
            'en' => 'Settings',
            'us' => 'Settings'
        ));
        I18n::make('admin_head_title', array(
            'de' => 'Einstellungen',
            'en' => 'Settings',
            'us' => 'Settings'
        ));
        I18n::make('app_claim', array(
            'de' => 'RAD with Cinnebar, Redbean and Flight',
            'en' => 'RAD with Cinnebar, Redbean and Flight',
            'us' => 'RAD with Cinnebar, Redbean and Flight'
        ));
        I18n::make('app_info', array(
            'de' => '<a href="http://kalaisoo.com/">Cinnebar</a> - <a href="http://glyphicons.com/">Glyphicons</a>',
            'en' => '<a href="http://kalaisoo.com/">Cinnebar</a> - <a href="http://glyphicons.com/">Glyphicons</a>',
            'us' => '<a href="http://kalaisoo.com/">Cinnebar</a> - <a href="http://glyphicons.com/">Glyphicons</a>'
        ));
        I18n::make('app_install_success', array(
            'de' => 'Das Grundsystem ist erfolgreich installiert',
            'en' => 'System was successfully installed',
            'us' => 'System was successfully installed'
        ));
        I18n::make('app_name', array(
            'de' => 'Cinnebar',
            'en' => 'Cinnebar',
            'us' => 'Cinnebar'
        ));
        //30
        I18n::make('browser_is_ancient', array(
            'de' => 'Ihr Browser ist alt',
            'en' => 'Your browser is ancient',
            'us' => 'Your browser is ancient'
        ));
        I18n::make('country_h1', array(
            'de' => 'Länder',
            'en' => 'Countries',
            'us' => 'Countries'
        ));
        I18n::make('country_label_enabled', array(
            'de' => 'Aktiviert',
            'en' => 'Enabled',
            'us' => 'Enabled'
        ));
        I18n::make('country_label_iso', array(
            'de' => 'ISO',
            'en' => 'ISO',
            'us' => 'ISO'
        ));
        I18n::make('country_label_name', array(
            'de' => 'Name',
            'en' => 'Name',
            'us' => 'Name'
        ));
        I18n::make('country_legend', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('country_placeholder_iso', array(
            'de' => 'it',
            'en' => 'it',
            'us' => 'it'
        ));
        I18n::make('country_placeholder_name', array(
            'de' => 'Italien',
            'en' => 'Italy',
            'us' => 'Italy'
        ));
        I18n::make('domain_action', array(
            'de' => 'Aktion',
            'en' => 'Action',
            'us' => 'Action'
        ));
        I18n::make('domain_action_nav', array(
            'de' => 'Aktionen',
            'en' => 'Actions',
            'us' => 'Actions'
        ));
        //40
        I18n::make('domain_admin_nav', array(
            'de' => 'Einstellungen',
            'en' => 'Settings',
            'us' => 'Settings'
        ));
        I18n::make('domain_country', array(
            'de' => 'Land',
            'en' => 'Country',
            'us' => 'Country'
        ));
        I18n::make('domain_country_nav', array(
            'de' => 'Länder',
            'en' => 'Countries',
            'us' => 'Countries'
        ));
        I18n::make('domain_domain', array(
            'de' => 'Verzeichnis',
            'en' => 'Domain',
            'us' => 'Domain'
        ));
        I18n::make('domain_domain_nav', array(
            'de' => 'Verzeichnisse',
            'en' => 'Domains',
            'us' => 'Domains'
        ));
        I18n::make('domain_h1', array(
            'de' => 'Verzeichnisse',
            'en' => 'Domains',
            'us' => 'Domains'
        ));
        I18n::make('domain_label_name', array(
            'de' => 'Bezeichnung',
            'en' => 'Name',
            'us' => 'Name'
        ));
        I18n::make('domain_language', array(
            'de' => 'Sprache',
            'en' => 'Language',
            'us' => 'Language'
        ));
        I18n::make('domain_language_nav', array(
            'de' => 'Sprachen',
            'en' => 'Languages',
            'us' => 'Languages'
        ));
        I18n::make('domain_legend', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        //50
        I18n::make('domain_placeholder_name', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('domain_role', array(
            'de' => 'Benutzerrolle',
            'en' => 'Userrole',
            'us' => 'Userrole'
        ));
        I18n::make('domain_role_nav', array(
            'de' => 'Benutzerrollen',
            'en' => 'Userroles',
            'us' => 'Userroles'
        ));
        I18n::make('domain_team', array(
            'de' => 'Team',
            'en' => 'Usergroup',
            'us' => 'Usergroup'
        ));
        I18n::make('domain_team_nav', array(
            'de' => 'Teams',
            'en' => 'Usergroups',
            'us' => 'Usergroups'
        ));
        I18n::make('domain_token', array(
            'de' => 'Token',
            'en' => 'Token',
            'us' => 'Token'
        ));
        I18n::make('domain_token_nav', array(
            'de' => 'Übersetzungen',
            'en' => 'Translations',
            'us' => 'Translations'
        ));
        I18n::make('domain_user', array(
            'de' => 'Benutzer',
            'en' => 'User',
            'us' => 'User'
        ));
        I18n::make('domain_user_nav', array(
            'de' => 'Benutzerkonten',
            'en' => 'Accounts',
            'us' => 'Accounts'
        ));
        I18n::make('filter_placeholder_any', array(
            'de' => 'Alle',
            'en' => 'Any',
            'us' => 'Any'
        ));
        //60
        I18n::make('filter_submit_clear', array(
            'de' => 'Filter zurücksetzen',
            'en' => 'Clear filters',
            'us' => 'Clear filters'
        ));
        I18n::make('filter_submit_refresh', array(
            'de' => 'Filter aktualisieren',
            'en' => 'Refresh filter',
            'us' => 'Refresh filter'
        ));
        I18n::make('language_de', array(
            'de' => 'Deutsch',
            'en' => 'German',
            'us' => 'German'
        ));
        I18n::make('language_en', array(
            'de' => 'Englisch',
            'en' => 'English',
            'us' => 'English'
        ));
        I18n::make('language_us', array(
            'de' => 'US Englisch',
            'en' => 'US English',
            'us' => 'US English'
        ));
        I18n::make('language_h1', array(
            'de' => 'Sprachen',
            'en' => 'Languages',
            'us' => 'Languages'
        ));
        I18n::make('language_label_enabled', array(
            'de' => 'Aktiviert',
            'en' => 'Enabled',
            'us' => 'Enabled'
        ));
        I18n::make('language_label_iso', array(
            'de' => 'ISO',
            'en' => 'ISO',
            'us' => 'ISO'
        ));
        I18n::make('language_label_name', array(
            'de' => 'Bezeichnung',
            'en' => 'Name',
            'us' => 'Name'
        ));
        I18n::make('language_legend', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('language_placeholder_iso', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('language_placeholder_name', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        //70
        I18n::make('login_h1', array(
            'de' => 'Anmeldung',
            'en' => 'Login',
            'us' => 'Login'
        ));
        I18n::make('login_head_title', array(
            'de' => 'Anmeldung',
            'en' => 'Login',
            'us' => 'Login'
        ));
        I18n::make('login_legend', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('login_password_label', array(
            'de' => 'Kennwort',
            'en' => 'Password',
            'us' => 'Password'
        ));
        I18n::make('login_submit', array(
            'de' => 'Anmelden',
            'en' => 'Log in',
            'us' => 'Log in'
        ));
        I18n::make('login_username_label', array(
            'de' => 'Konto',
            'en' => 'Account',
            'us' => 'Account'
        ));
        I18n::make('login_username_placeholder', array(
            'de' => 'ich@example.com',
            'en' => 'you@example.com',
            'us' => 'you@example.com'
        ));
        I18n::make('notfound_head_title', array(
            'de' => 'Seite nicht gefunden',
            'en' => 'Page not found',
            'us' => 'Page not found'
        ));
        I18n::make('pagination_page_next', array(
            'de' => 'Nächste',
            'en' => 'Next',
            'us' => 'Next'
        ));
        I18n::make('pagination_page_prev', array(
            'de' => 'Vorige',
            'en' => 'Previous',
            'us' => 'Previous'
        ));
        //80
        I18n::make('role_h1', array(
            'de' => 'Benutzerrollen',
            'en' => 'Userroles',
            'us' => 'Userroles'
        ));
        I18n::make('role_label_name', array(
            'de' => 'Bezeichnung',
            'en' => 'Name',
            'us' => 'Name'
        ));
        I18n::make('role_legend', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('role_placeholder_name', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('scaffold_action_edit', array(
            'de' => 'Bearbeiten',
            'en' => 'Edit',
            'us' => 'Edit'
        ));
        I18n::make('scaffold_caption_index', array(
            'de' => '%d Einträge',
            'en' => '%d Items',
            'us' => '%d Items'
        ));
        I18n::make('scaffold_head_title_add', array(
            'de' => 'Einen neuen Eintrag hinzufügen',
            'en' => 'Add a new entry',
            'us' => 'Add a new entry'
        ));
        I18n::make('scaffold_head_title_edit', array(
            'de' => 'Bearbeiten eines Eintrages',
            'en' => 'Edit a item',
            'us' => 'Edit a item'
        ));
        I18n::make('scaffold_head_title_index', array(
            'de' => 'Blättern',
            'en' => 'Browse',
            'us' => 'Browse'
        ));
        I18n::make('scaffold_select_all', array(
            'de' => 'Markierung für alle setzen oder aufheben',
            'en' => 'Select or deselect items',
            'us' => 'Select or deselect items'
        ));
        //90
        I18n::make('scaffold_submit_apply_action', array(
            'de' => 'Ausführen',
            'en' => 'Run',
            'us' => 'Go'
        ));
        I18n::make('scaffold_success_edit', array(
            'de' => 'Der Eintrag wurde geändert',
            'en' => 'Item was changed',
            'us' => 'Item was changed'
        ));
        I18n::make('sys_info', array(
            'de' => '%sMB - IP: %s',
            'en' => '%sMB - IP: %s',
            'us' => '%sMB - IP: %s'
        ));
        I18n::make('team_h1', array(
            'de' => 'Teams',
            'en' => 'Usergroups',
            'us' => 'Usergroups'
        ));
        I18n::make('team_label_name', array(
            'de' => 'Bezeichnung',
            'en' => 'Name',
            'us' => 'Name'
        ));
        I18n::make('team_legend', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('team_placeholder_name', array(
            'de' => 'Entwicklung',
            'en' => 'Development',
            'us' => 'Development'
        ));
        I18n::make('token_h1', array(
            'de' => 'Übersetzungen',
            'en' => 'Translations',
            'us' => 'Translations'
        ));
        I18n::make('token_label_desc', array(
            'de' => 'Beschreibung',
            'en' => 'Description',
            'us' => 'Description'
        ));
        //100
        I18n::make('token_label_i18n_name', array(
            'de' => 'Übersetzung',
            'en' => 'Translation',
            'us' => 'Translation'
        ));
        I18n::make('token_label_name', array(
            'de' => 'Menomic',
            'en' => 'Menomic',
            'us' => 'Menomic'
        ));
        I18n::make('token_legend', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('token_placeholder_desc', array(
            'de' => 'Beschreibung eventueller Ersetzungsparameter und Verwendungszweck',
            'en' => 'Document this token',
            'us' => 'Document this token'
        ));
        I18n::make('token_placeholder_name', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('tokeni18n_legend', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('user_label_email', array(
            'de' => 'E-Mail',
            'en' => 'Email',
            'us' => 'Email'
        ));
        I18n::make('user_h1', array(
            'de' => 'Benutzerkonten',
            'en' => 'Accounts',
            'us' => 'Accounts'
        ));
        I18n::make('user_label_isadmin', array(
            'de' => 'Darf das System verwalten',
            'en' => 'Systemadministrator',
            'us' => 'Systemadministrator'
        ));
        //110
        I18n::make('user_label_name', array(
            'de' => 'Name',
            'en' => 'Name',
            'us' => 'Name'
        ));
        I18n::make('user_legend', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('user_placeholder_email', array(
            'de' => 'ich@example.com',
            'en' => 'you@example.com',
            'us' => 'you@example.com'
        ));
        I18n::make('user_placeholder_name', array(
            'de' => 'Vor- und Zuname',
            'en' => 'Full name',
            'us' => 'Full name'
        ));
        I18n::make('user_placeholder_shortname', array(
            'de' => 'admin',
            'en' => 'admin',
            'us' => 'admin'
        ));
        I18n::make('user_pw_label', array(
            'de' => 'Kennwort',
            'en' => 'Password',
            'us' => 'Password'
        ));
        I18n::make('user_shortname_label', array(
            'de' => 'Kurzname',
            'en' => 'Screenname',
            'us' => 'Screenname'
        ));
        I18n::make('welcome_head_title', array(
            'de' => 'Willkommen - Diese Seite ist absichtlich leer',
            'en' => 'Welcome - This page is intenionally left blank',
            'us' => 'Welcome - This page is intenionally left blank'
        ));
        I18n::make('validator_hasvalue_invalid', array(
            'de' => 'fehlende Angabe',
            'en' => 'missing value',
            'us' => 'missing value'
        ));
        I18n::make('validator_isdate_invalid', array(
            'de' => 'ist ein fehlerhaftes Datum',
            'en' => 'is an invalid date',
            'us' => 'is an invalid date'
        ));
        I18n::make('validator_isemail_invalid', array(
            'de' => 'ist keine als gültig erkannte E-Mail Adresse',
            'en' => 'was not found to be a valid email address',
            'us' => 'was not found to be a valid email address'
        ));
        I18n::make('validator_isnumeric_invalid', array(
            'de' => 'ist keine Zahl',
            'en' => 'is not a number',
            'us' => 'is not a number'
        ));
        I18n::make('validator_isunique_invalid', array(
            'de' => 'ist bereits vorhanden',
            'en' => 'is not unique',
            'us' => 'is not unique'
        ));
        I18n::make('validator_range_invalid', array(
            'de' => 'liegt ausserhalb des gültigen Bereiches',
            'en' => 'is out of range',
            'us' => 'is out of range'
        ));
        //account
        I18n::make('account_h1', array(
            'de' => 'Benutzerkonto',
            'en' => 'Profile',
            'us' => 'Profile'
        ));
        I18n::make('account_head_title', array(
            'de' => 'Benutzerkonto',
            'en' => 'Profile',
            'us' => 'Profile'
        ));
        I18n::make('account_index_nav', array(
            'de' => 'Profil',
            'en' => 'Profile',
            'us' => 'Profile'
        ));
        I18n::make('account_changepassword_nav', array(
            'de' => 'Kennwort',
            'en' => 'Password',
            'us' => 'Password'
        ));
        I18n::make('account_legend', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('account_newpassword_label', array(
            'de' => 'Neues Kennwort',
            'en' => 'New password',
            'us' => 'New password'
        ));
        I18n::make('account_repeatedpassword_label', array(
            'de' => 'Wiederholung',
            'en' => 'Repeat password',
            'us' => 'Repeat password'
        ));
        I18n::make('account_submit', array(
            'de' => 'Aktualisieren',
            'en' => 'Update',
            'us' => 'Update'
        ));
        I18n::make('account_submit_changepassword', array(
            'de' => 'Kennwort ändern',
            'en' => 'Change password',
            'us' => 'Change password'
        ));
        I18n::make('account_edit_success', array(
            'de' => 'Benutzerkonto ist geändert',
            'en' => 'Profile updated',
            'us' => 'Profile updated'
        ));
        I18n::make('account_edit_failure', array(
            'de' => 'Benutzerkonto ist nicht geändert',
            'en' => 'Profile was not updated',
            'us' => 'Profile was not updated'
        ));
        I18n::make('account_changepassword_success', array(
            'de' => 'Kennwort ist geändert',
            'en' => 'Password was changed',
            'us' => 'Password was changed'
        ));
        I18n::make('account_changepassword_failure', array(
            'de' => 'Kennwort wurde nicht geändert',
            'en' => 'Password was not changed',
            'us' => 'Password was not changed'
        ));
    }
    
    /**
     * getQueriesFromSQLFile parses a sql file and extracts all queries
     * for further processing with pdo execute.
     *
     * Taken from {@link http://jakoch.de/2012/02/27/php-importsql-und-getqueriesfromsqlfile/}.
     *
     * - strips off all comments, sql notes, empty lines from an sql file
     * - trims white-spaces
     * - filters the sql-string for sql-keywords
     * - replaces the db_prefix is not used, but can be uncommented
     *
     * @param $file sqlfile
     * @return array Trimmed array of sql queries, ready for insertion into db.
     */
    protected function getQueriesFromSQLFile($sqlfile)
    {
        if(is_readable($sqlfile) === false)
        {
            throw new Exception($sqlfile . 'does not exist or is not readable.');
        }

        # read file into array
        $file = file($sqlfile);

        # import file line by line
        # and filter (remove) those lines, beginning with an sql comment token
        $file = array_filter($file,
                        create_function('$line',
                                'return strpos(ltrim($line), "--") !== 0;'));

        # and filter (remove) those lines, beginning with an sql notes token
        $file = array_filter($file,
                        create_function('$line',
                                'return strpos(ltrim($line), "/*") !== 0;'));

        # this is a whitelist of SQL commands, which are allowed to follow a semicolon
        $keywords = array(
            'ALTER', 'CREATE', 'DELETE', 'DROP', 'INSERT',
            'REPLACE', 'SELECT', 'SET', 'TRUNCATE', 'UPDATE', 'USE'
        );

        # create the regular expression for matching the whitelisted keywords
        $regexp = sprintf('/\s*;\s*(?=(%s)\b)/s', implode('|', $keywords));

        # split there
        $splitter = preg_split($regexp, implode("\r\n", $file));

        # remove trailing semicolon or whitespaces
        $splitter = array_map(create_function('$line',
                                'return preg_replace("/[\s;]*$/", "", $line);'),
                              $splitter);

        # replace the default database prefix "your_prefix_"
        #$table_prefix = $_POST['config']['database']['prefix'];
        #$splitter = preg_replace("/`your_prefix_/", "`$table_prefix", $splitter);

        # remove empty lines
        return array_filter($splitter, create_function('$line', 'return !empty($line);'));
    }
}
