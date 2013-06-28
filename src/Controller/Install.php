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
        if ($setting = R::findOne('setting', ' installed = ?', array(true))) $this->redirect('/admin');
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
        //setting, will be stored at the end of this
        $setting = R::dispense('setting');
        //...
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
        $domains = R::dispense('domain', 16);

        $domains[0]->name = 'system';
        $domains[0]->url = 'system';
        //$domains[0]->blessed = true;
        $domains[0]->sequence = 0;
        $sys_i18n = R::dispense('domaini18n', 3);
        $sys_i18n[0]->language = 'de';
        $sys_i18n[0]->name = 'System';
        $sys_i18n[1]->language = 'en';
        $sys_i18n[1]->name = 'System';
        $sys_i18n[2]->language = 'us';
        $sys_i18n[2]->name = 'System';
        $domains[0]->ownDomaini18n = array(
            $sys_i18n[0], $sys_i18n[1], $sys_i18n[2]
        );
        
        
            $domains[1]->name = 'admin';
            $domains[1]->url = 'admin';
            $domains[1]->sequence = 10000;
            $admin_i18n = R::dispense('domaini18n', 3);
            $admin_i18n[0]->language = 'de';
            $admin_i18n[0]->name = 'Einstellungen';
            $admin_i18n[1]->language = 'en';
            $admin_i18n[1]->name = 'Settings';
            $admin_i18n[2]->language = 'us';
            $admin_i18n[2]->name = 'Settings';
            $domains[1]->ownDomaini18n = array(
                $admin_i18n[0], $admin_i18n[1], $admin_i18n[2]
            );
            
                $domains[2]->name = 'user';
                $domains[2]->url = 'admin/user';
                $domains[2]->sequence = 10;
                $user_i18n = R::dispense('domaini18n', 3);
                $user_i18n[0]->language = 'de';
                $user_i18n[0]->name = 'Benutzerkonten';
                $user_i18n[1]->language = 'en';
                $user_i18n[1]->name = 'Accounts';
                $user_i18n[2]->language = 'us';
                $user_i18n[2]->name = 'Accounts';
                $domains[2]->ownDomaini18n = array(
                    $user_i18n[0], $user_i18n[1], $user_i18n[2]
                );
                
                $domains[3]->name = 'language';
                $domains[3]->url = 'admin/language';
                $domains[3]->sequence = 20;
                $lang_i18n = R::dispense('domaini18n', 3);
                $lang_i18n[0]->language = 'de';
                $lang_i18n[0]->name = 'Sprachen';
                $lang_i18n[1]->language = 'en';
                $lang_i18n[1]->name = 'Languages';
                $lang_i18n[2]->language = 'us';
                $lang_i18n[2]->name = 'Languages';
                $domains[3]->ownDomaini18n = array(
                    $lang_i18n[0], $lang_i18n[1], $lang_i18n[2]
                );
                
                $domains[15]->name = 'currency';
                $domains[15]->url = 'admin/currency';
                $domains[15]->sequence = 25;
                $curr_i18n = R::dispense('domaini18n', 3);
                $curr_i18n[0]->language = 'de';
                $curr_i18n[0]->name = 'Währungen';
                $curr_i18n[1]->language = 'en';
                $curr_i18n[1]->name = 'Currencies';
                $curr_i18n[2]->language = 'us';
                $curr_i18n[2]->name = 'Currencies';
                $domains[15]->ownDomaini18n = array(
                    $curr_i18n[0], $curr_i18n[1], $curr_i18n[2]
                );
                
                $domains[4]->name = 'country';
                $domains[4]->url = 'admin/country';
                $domains[4]->sequence = 30;
                $country_i18n = R::dispense('domaini18n', 3);
                $country_i18n[0]->language = 'de';
                $country_i18n[0]->name = 'Länder';
                $country_i18n[1]->language = 'en';
                $country_i18n[1]->name = 'Countries';
                $country_i18n[2]->language = 'us';
                $country_i18n[2]->name = 'Countries';
                $domains[4]->ownDomaini18n = array(
                    $country_i18n[0], $country_i18n[1], $country_i18n[2]
                );
                
                $domains[5]->name = 'domain';
                $domains[5]->url = 'admin/domain';
                $domains[5]->sequence = 40;
                $domain_i18n = R::dispense('domaini18n', 3);
                $domain_i18n[0]->language = 'de';
                $domain_i18n[0]->name = 'Verzeichnisse';
                $domain_i18n[1]->language = 'en';
                $domain_i18n[1]->name = 'Domains';
                $domain_i18n[2]->language = 'us';
                $domain_i18n[2]->name = 'Domains';
                $domains[5]->ownDomaini18n = array(
                    $domain_i18n[0], $domain_i18n[1], $domain_i18n[2]
                );
                
                $domains[6]->name = 'action';
                $domains[6]->url = 'admin/action';
                $domains[6]->sequence = 50;
                $action_i18n = R::dispense('domaini18n', 3);
                $action_i18n[0]->language = 'de';
                $action_i18n[0]->name = 'Kommandos';
                $action_i18n[1]->language = 'en';
                $action_i18n[1]->name = 'Actions';
                $action_i18n[2]->language = 'us';
                $action_i18n[2]->name = 'Actions';
                $domains[6]->ownDomaini18n = array(
                    $action_i18n[0], $action_i18n[1], $action_i18n[2]
                );
                
                $domains[7]->name = 'role';
                $domains[7]->url = 'admin/role';
                $domains[7]->sequence = 60;
                $role_i18n = R::dispense('domaini18n', 3);
                $role_i18n[0]->language = 'de';
                $role_i18n[0]->name = 'Rollen';
                $role_i18n[1]->language = 'en';
                $role_i18n[1]->name = 'Roles';
                $role_i18n[2]->language = 'us';
                $role_i18n[2]->name = 'Roles';
                $domains[7]->ownDomaini18n = array(
                    $role_i18n[0], $role_i18n[1], $role_i18n[2]
                );
                
                $domains[8]->name = 'team';
                $domains[8]->url = 'admin/team';
                $domains[8]->sequence = 70;
                $team_i18n = R::dispense('domaini18n', 3);
                $team_i18n[0]->language = 'de';
                $team_i18n[0]->name = 'Teams';
                $team_i18n[1]->language = 'en';
                $team_i18n[1]->name = 'Groups';
                $team_i18n[2]->language = 'us';
                $team_i18n[2]->name = 'Groups';
                $domains[8]->ownDomaini18n = array(
                    $team_i18n[0], $team_i18n[1], $team_i18n[2]
                );
                
                $domains[9]->name = 'token';
                $domains[9]->url = 'admin/token';
                $domains[9]->sequence = 80;
                $token_i18n = R::dispense('domaini18n', 3);
                $token_i18n[0]->language = 'de';
                $token_i18n[0]->name = 'Übersetzungen';
                $token_i18n[1]->language = 'en';
                $token_i18n[1]->name = 'Translations';
                $token_i18n[2]->language = 'us';
                $token_i18n[2]->name = 'Translations';
                $domains[9]->ownDomaini18n = array(
                    $token_i18n[0], $token_i18n[1], $token_i18n[2]
                );
                
            $domains[10]->name = 'cms';
            $domains[10]->url = 'cms';
            $domains[10]->sequence = 0;
            $cms_i18n = R::dispense('domaini18n', 3);
            $cms_i18n[0]->language = 'de';
            $cms_i18n[0]->name = 'CMS';
            $cms_i18n[1]->language = 'en';
            $cms_i18n[1]->name = 'CMS';
            $domain_i18n[2]->language = 'us';
            $cms_i18n[2]->name = 'CMS';
            $domains[10]->ownDomaini18n = array(
                $cms_i18n[0], $cms_i18n[1], $cms_i18n[2]
            );
            
                $domains[11]->name = 'media';
                $domains[11]->url = 'cms/media';
                $domains[11]->sequence = 10;
                $media_i18n = R::dispense('domaini18n', 3);
                $media_i18n[0]->language = 'de';
                $media_i18n[0]->name = 'Medien';
                $media_i18n[1]->language = 'en';
                $media_i18n[1]->name = 'Media';
                $media_i18n[2]->language = 'us';
                $media_i18n[2]->name = 'Media';
                $domains[11]->ownDomaini18n = array(
                    $media_i18n[0], $media_i18n[1], $media_i18n[2]
                );
                
                $domains[12]->name = 'page';
                $domains[12]->url = 'cms/page';
                $domains[12]->sequence = 20;
                $page_i18n = R::dispense('domaini18n', 3);
                $page_i18n[0]->language = 'de';
                $page_i18n[0]->name = 'Webseiten';
                $page_i18n[1]->language = 'en';
                $page_i18n[1]->name = 'Webpages';
                $page_i18n[2]->language = 'us';
                $page_i18n[2]->name = 'Webpages';
                $domains[12]->ownDomaini18n = array(
                    $page_i18n[0], $page_i18n[1], $page_i18n[2]
                );
                
                $domains[13]->name = 'module';
                $domains[13]->url = 'cms/module';
                $domains[13]->sequence = 30;
                $module_i18n = R::dispense('domaini18n', 3);
                $module_i18n[0]->language = 'de';
                $module_i18n[0]->name = 'Modulen';
                $module_i18n[1]->language = 'en';
                $module_i18n[1]->name = 'Modules';
                $module_i18n[2]->language = 'us';
                $module_i18n[2]->name = 'Modules';
                $domains[13]->ownDomaini18n = array(
                    $module_i18n[0], $module_i18n[1], $module_i18n[2]
                );
                
                $domains[14]->name = 'template';
                $domains[14]->url = 'cms/template';
                $domains[14]->sequence = 40;
                $template_i18n = R::dispense('domaini18n', 3);
                $template_i18n[0]->language = 'de';
                $template_i18n[0]->name = 'Templates';
                $template_i18n[1]->language = 'en';
                $template_i18n[1]->name = 'Templates';
                $template_i18n[2]->language = 'us';
                $template_i18n[2]->name = 'Templates';
                $domains[14]->ownDomaini18n = array(
                    $template_i18n[0], $template_i18n[1], $template_i18n[2]
                );
                
        // make a tree
        $domains[1]->ownDomain = array(
            $domains[2],
            $domains[3],
            $domains[4],
            $domains[5],
            $domains[6],
            $domains[7],
            $domains[8],
            $domains[9],
            $domains[15]
        );
        $domains[10]->ownDomain = array(
            $domains[11],
            $domains[12],
            $domains[13],
            $domains[14]
        );  
        $domains[0]->ownDomain = array(
            $domains[1], $domains[10]
        );
        //store system tree       
        R::store($domains[0]);
        //make system the blessed folder
        $setting->blessedfolder = $domains[0]->getId();
        $setting->sitesfolder = $domains[12]->getId();

        //modules
        $modules = R::dispense('module', 4);
        $modules[0]->name = 'textile';
        $modules[0]->enabled = true;
        $modules[1]->name = 'text';
        $modules[1]->enabled = true;
        $modules[2]->name = 'image';
        $modules[2]->enabled = true;
        $modules[3]->name = 'html';
        $modules[3]->enabled = true;
        R::storeAll($modules);
        
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
        
        //currency
        $currencies = R::dispense('currency', 3);
        $currencies[0]->iso = 'eur';
        $currencies[0]->name = 'Euro';
        $currencies[0]->enabled = true;
        $currencies[0]->sign = '€';
        $currencies[0]->fractionalunit = 'Cent';
        $currencies[0]->numbertobasic = 100;
        $currencies[0]->exchangerate = (double)1.000;
        //gbp
        $currencies[1]->iso = 'gbp';
        $currencies[1]->name = 'Pound Sterling';
        $currencies[1]->enabled = true;
        $currencies[1]->sign = '£';
        $currencies[1]->fractionalunit = 'Pence';
        $currencies[1]->numbertobasic = 100;
        $currencies[1]->exchangerate = (double)0.8490;
        //usd
        $currencies[2]->iso = 'usd';
        $currencies[2]->name = 'US Dollar';
        $currencies[2]->enabled = true;
        $currencies[2]->sign = '$';
        $currencies[2]->fractionalunit = 'Cent';
        $currencies[2]->numbertobasic = 100;
        $currencies[2]->exchangerate = (double)1.2861;
        R::storeAll($currencies);
        
        $setting->basecurrency = $currencies[0]->getId();

        //role
        $roles = R::dispense('role', 2);
        $roles[0]->name = 'Admin';
        $roles[1]->name = 'User';
        R::storeAll($roles);
        //team
        $team = R::dispense('team');
        $team->name = 'Development';
        R::store($team);
        //template
        $template = R::dispense('template');
        $template->name = 'Default';
        $region = R::dispense('region');
        $region->name = 'Content';
        $template->ownRegion = array(
            $region
        );
        R::store($template);
        //token
        
        // added 2013-06-28
        I18n::make('setting_legend', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('setting_legend_currency', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('setting_legend_folder', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('setting_blessedfolder_label', array(
            'de' => 'Systemordner',
            'en' => 'Blessed Folder',
            'us' => 'Blessed Folder'
        ));
        I18n::make('setting_sitesfolder_label', array(
            'de' => 'Webseiten',
            'en' => 'Websites',
            'us' => 'Websites'
        ));
        I18n::make('setting_fiscalyear_label', array(
            'de' => 'Rechnungsjahr',
            'en' => 'Fiscal Year',
            'us' => 'Fiscal Year'
        ));
        I18n::make('setting_basecurrency_label', array(
            'de' => 'Basiswährung',
            'en' => 'Base Currency',
            'us' => 'Base Currency'
        ));
        I18n::make('setting_exchangerateservice_label', array(
            'de' => 'Service',
            'en' => 'Service',
            'us' => 'Service'
        ));
        I18n::make('setting_loadexchangerates_label', array(
            'de' => 'Kurse',
            'en' => 'Rates',
            'us' => 'Rates'
        ));
        I18n::make('setting_loadexchangerates_no', array(
            'de' => 'Zuletzt aktualisiert %s',
            'en' => 'Last updated %s',
            'us' => 'Last updated %s'
        ));
        I18n::make('setting_loadexchangerates_yes', array(
            'de' => 'Jetzt aktualisieren',
            'en' => 'Update now',
            'us' => 'Update now'
        ));
        I18n::make('setting_folder_tab', array(
            'de' => 'Ordner',
            'en' => 'Folders',
            'us' => 'Folders'
        ));
        I18n::make('admin_submit_setting', array(
            'de' => 'Aktualisieren',
            'en' => 'Update',
            'us' => 'Update'
        ));
        I18n::make('setting_currency_tab', array(
            'de' => 'Währung und Kurse',
            'en' => 'Currency and Rates',
            'us' => 'Currency and Rates'
        ));
        I18n::make('currency_h1', array(
            'de' => 'Währungen',
            'en' => 'Currencies',
            'us' => 'Currencies'
        ));
        I18n::make('currency_legend', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('currency_label_iso', array(
            'de' => 'ISO',
            'en' => 'ISO',
            'us' => 'ISO'
        ));
        I18n::make('currency_label_enabled', array(
            'de' => 'Aktiviert',
            'en' => 'Active',
            'us' => 'Active'
        ));
        I18n::make('currency_label_name', array(
            'de' => 'Name',
            'en' => 'Name',
            'us' => 'Name'
        ));
        I18n::make('currency_label_sign', array(
            'de' => 'Zeichen',
            'en' => 'Sign',
            'us' => 'Sign'
        ));
        I18n::make('currency_label_fractionalunit', array(
            'de' => 'Kleinste Einheit',
            'en' => 'Fractional Unit',
            'us' => 'Fractional Unit'
        ));
        I18n::make('currency_label_numbertobasic', array(
            'de' => 'Basiszahl',
            'en' => 'Number to Basic',
            'us' => 'Number to Basic'
        ));
        I18n::make('currency_exchangerate_label', array(
            'de' => 'Kurs',
            'en' => 'Exchangerate',
            'us' => 'Exchangerate'
        ));
        
        
        // added 2013-06-24
        I18n::make('scaffold_no_records_add_one', array(
            'de' => 'Es sind noch keine Einträge vorhanden. Erstellen Sie den ersten.',
            'en' => 'Go ahead and add the first item',
            'us' => 'Go ahead and add the first item'
        ));
        I18n::make('scaffold_success_index', array(
            'de' => 'Die Aktion wurde auf %d Einträge angewandt',
            'en' => 'Action was applied to %d items',
            'us' => 'Action was applied to %d items'
        ));
        I18n::make('scaffold_error_index', array(
            'de' => 'Die Aktion konnte nicht auf die Auswahl angewandt werden',
            'en' => 'Action was not applied the selection',
            'us' => 'Action was not applied the selection'
        ));
        I18n::make('scaffold_success_add', array(
            'de' => 'Ein Eintrag wurde erfolgreich hinzugefügt',
            'en' => 'Added a new item successfully',
            'us' => 'Added a new item successfully'
        ));
        I18n::make('scaffold_error_add', array(
            'de' => 'Der Eintrag konnte nicht hinzugefügt werden',
            'en' => 'The new item was not added',
            'us' => 'The new item was not added'
        ));
        I18n::make('page_label_keywords', array(
            'de' => 'Suchbegriffe',
            'en' => 'Keywords',
            'us' => 'Keywords'
        ));
        I18n::make('page_label_desc', array(
            'de' => 'Beschreibung',
            'en' => 'Description',
            'us' => 'Description'
        ));
        I18n::make('template_region_tab', array(
            'de' => 'Bereiche',
            'en' => 'Regions',
            'us' => 'Regions'
        ));
        
        I18n::make('cms_h1', array(
            'de' => 'CMS',
            'en' => 'CMS',
            'us' => 'CMS'
        ));
        I18n::make('scaffold_detach_linktext', array(
            'de' => 'Entfernen',
            'en' => 'Detach',
            'us' => 'Detach'
        ));
        I18n::make('scaffold_attach_linktext', array(
            'de' => 'Hinzufügen',
            'en' => 'Attach',
            'us' => 'Attach'
        ));
        I18n::make('domain_label_parent', array(
            'de' => 'Übergeordnet',
            'en' => 'Parent',
            'us' => 'Parent'
        ));
        I18n::make('domain_parent_none', array(
            'de' => 'Ohne',
            'en' => 'None',
            'us' => 'None'
        ));
        I18n::make('domain_label_invisible', array(
            'de' => 'Nicht sichtbar',
            'en' => 'Invisible',
            'us' => 'Invisible'
        ));
        I18n::make('domain_label_sequence', array(
            'de' => 'Reihenfolge',
            'en' => 'Sequence',
            'us' => 'Sequence'
        ));
        I18n::make('token_translation_tab', array(
            'de' => 'Übersetzungen',
            'en' => 'Translations',
            'us' => 'Translations'
        ));
        I18n::make('user_setting_tab', array(
            'de' => 'Einstellungen',
            'en' => 'Settings',
            'us' => 'Settings'
        ));
        I18n::make('user_role_tab', array(
            'de' => 'Rollen',
            'en' => 'Roles',
            'us' => 'Roles'
        ));
        I18n::make('user_team_tab', array(
            'de' => 'Teams',
            'en' => 'Groups',
            'us' => 'Groups'
        ));
        I18n::make('user_legend_setting', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('user_legend_role', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('user_legend_team', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('role_translation_tab', array(
            'de' => 'Übersetzungen',
            'en' => 'Translations',
            'us' => 'Translations'
        ));
        I18n::make('team_translation_tab', array(
            'de' => 'Übersetzungen',
            'en' => 'Translations',
            'us' => 'Translations'
        ));
        I18n::make('domain_translation_tab', array(
            'de' => 'Übersetzungen',
            'en' => 'Translations',
            'us' => 'Translations'
        ));
        I18n::make('domain_label_url', array(
            'de' => 'URL',
            'en' => 'URL',
            'us' => 'URL'
        ));
        I18n::make('domain_placeholder_url', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('page_h1', array(
            'de' => 'Webseiten',
            'en' => 'Webpages',
            'us' => 'Webpages'
        ));
        I18n::make('page_legend', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('page_label_name', array(
            'de' => 'Titel',
            'en' => 'Title',
            'us' => 'Title'
        ));
        I18n::make('page_legend_meta', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('page_label_domain', array(
            'de' => 'Verzeichnis',
            'en' => 'Domain',
            'us' => 'Domain'
        ));
        I18n::make('page_placeholder_name', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('page_label_invisible', array(
            'de' => 'Nicht sichtbar',
            'en' => 'Invisible',
            'us' => 'Invisible'
        ));
        I18n::make('page_domain_none', array(
            'de' => 'Ohne',
            'en' => 'None',
            'us' => 'None'
        ));
        I18n::make('page_label_template', array(
            'de' => 'Template',
            'en' => 'Template',
            'us' => 'Template'
        ));
        I18n::make('page_label_sequence', array(
            'de' => 'Reihenfolge',
            'en' => 'Sequence',
            'us' => 'Sequence'
        ));
        I18n::make('page_template_none', array(
            'de' => 'Ohne',
            'en' => 'None',
            'us' => 'None'
        ));
        I18n::make('page_region_tab', array(
            'de' => 'Bereiche',
            'en' => 'Regions',
            'us' => 'Regions'
        ));
        I18n::make('page_meta_tab', array(
            'de' => 'Meta',
            'en' => 'Meta',
            'us' => 'Meta'
        ));
        I18n::make('page_legend_region', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('page_label_url', array(
            'de' => 'URL',
            'en' => 'URL',
            'us' => 'URL'
        ));
        I18n::make('page_placeholder_url', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('template_h1', array(
            'de' => 'Templates',
            'en' => 'Templates',
            'us' => 'Templates'
        ));
        I18n::make('template_legend', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('template_label_name', array(
            'de' => 'Name',
            'en' => 'Name',
            'us' => 'Name'
        ));
        I18n::make('template_placeholder_name', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('template_legend_region', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('region_legend', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('region_label_name', array(
            'de' => '%d Bereich',
            'en' => '%d Region',
            'us' => '%d Region'
        ));
        I18n::make('region_placeholder_name', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('module_h1', array(
            'de' => 'Modulen',
            'en' => 'Modules',
            'us' => 'Modules'
        ));
        I18n::make('module_legend', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('module_label_name', array(
            'de' => 'Name',
            'en' => 'Name',
            'us' => 'Name'
        ));
        I18n::make('module_placeholder_name', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('module_label_enabled', array(
            'de' => 'Aktiviert',
            'en' => 'Enabled',
            'us' => 'Enabled'
        ));
        I18n::make('slice_module_select', array(
            'de' => 'Modul wählen&hellip;',
            'en' => 'Choose module&hellip;',
            'us' => 'Choose module&hellip;'
        ));
        I18n::make('slice_module_not_set', array(
            'de' => '&hellip; um Inhalte einzutragen',
            'en' => '&hellip; and enter content',
            'us' => '&hellip; and enter content'
        ));
        I18n::make('slice_media_select', array(
            'de' => 'Medium&hellip;',
            'en' => 'Media&hellip;',
            'us' => 'Media&hellip;'
        ));
        I18n::make('module_textile', array(
            'de' => 'Textile',
            'en' => 'Textile',
            'us' => 'Textile'
        ));
        I18n::make('module_image', array(
            'de' => 'Bild',
            'en' => 'Image',
            'us' => 'Image'
        ));
        I18n::make('module_text', array(
            'de' => 'Nur-Text',
            'en' => 'Text-Only',
            'us' => 'Text-Only'
        ));
        I18n::make('module_html', array(
            'de' => 'HTML',
            'en' => 'HTML',
            'us' => 'HTML'
        ));
        I18n::make('media_h1', array(
            'de' => 'Medien',
            'en' => 'Media',
            'us' => 'Media'
        ));
        I18n::make('media_legend', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('media_label_name', array(
            'de' => 'Name',
            'en' => 'Name',
            'us' => 'Name'
        ));
        I18n::make('media_placeholder_name', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('media_label_desc', array(
            'de' => 'Beschreibung',
            'en' => 'Description',
            'us' => 'Description'
        ));
        I18n::make('media_placeholder_desc', array(
            'de' => '',
            'en' => '',
            'us' => ''
        ));
        I18n::make('media_label_file', array(
            'de' => 'Datei',
            'en' => 'Filename',
            'us' => 'Filename'
        ));
        I18n::make('media_label_extension', array(
            'de' => 'Art',
            'en' => 'Type',
            'us' => 'Type'
        ));
        I18n::make('media_label_size', array(
            'de' => 'Größe in Bytes',
            'en' => 'Bytes',
            'us' => 'Bytes'
        ));
        I18n::make('media_label_sanename', array(
            'de' => 'Datei',
            'en' => 'File',
            'us' => 'File'
        ));
        
        
        
        
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
        I18n::make('user_label_isbanned', array(
            'de' => 'Konto ist zur Zeit gesperrt',
            'en' => 'Banned',
            'us' => 'Banned'
        ));
        I18n::make('user_label_isdeleted', array(
            'de' => 'Konto zur Löschung vorgesehen',
            'en' => 'Deleted',
            'us' => 'Deleted'
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
        
        //at the end we save setting
        $setting->installed = true;
        $setting->fiscalyear = date('Y');
        $setting->exchangerateservice = 'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';//
        $setting->exchangeratelastupd = date('Y-m-d');//never did
        R::store($setting);
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
