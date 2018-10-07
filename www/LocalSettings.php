<?php
# This file was automatically generated by the MediaWiki 1.27.0
# installer at first.
#
# See includes/DefaultSettings.php for all configurable settings
# and their default values, but don't forget to make changes in _this_
# file, not there.
#
# Further documentation for configuration settings may be found at:
# https://www.mediawiki.org/wiki/Manual:Configuration_settings

# Protect against web entry
if (!defined('MEDIAWIKI')) {
    exit;
}

## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

$wgSitename = "페미위키";

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = "";
$wgArticlePath = "/w/$1";

## The protocol and server name to use in fully-qualified URLs
$wgServer = "PROTOCOL://HOST";
$wgCanonicalServer = "PROTOCOL://HOST";
$wgEnableCanonicalServerLink = true;

## The URL path to static resources (images, scripts, etc.)
$wgResourceBasePath = $wgScriptPath;

$wgStyleVersion = '20181007_0';
$wgResourceLoaderMaxage = [
    'versioned' => [
        // Squid/Varnish but also any other public proxy cache between the client and MediaWiki
        'server' => 90 * 24 * 60 * 60, // 90 days
        // On the client side (e.g. in the browser cache).
        'client' => 90 * 24 * 60 * 60, // 90 days
    ],
    'unversioned' => [
        'server' => 3 * 60, // 3 mins
        'client' => 3 * 60, // 3 mins
    ],
];

## The URL path to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogo = "$wgResourceBasePath/skins/Femiwiki/images/logo-1200-630.png";
# @todo Add $wgLogoHD 

## UPO means: this is also a user preference option
$wgEnableEmail = true;
$wgEnableUserEmail = true; # UPO

$wgEmergencyContact = "admin@femiwiki.com";
$wgPasswordSender = "admin@femiwiki.com";
$wgUserEmailUseReplyTo = true;

$wgEnotifUserTalk = false; # UPO
$wgEnotifWatchlist = false; # UPO
$wgEmailAuthentication = true;

# Database settings
$wgDBtype = "mysql";
$wgDBname = "femiwiki";

# MySQL specific settings
$wgDBprefix = "";

# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";

## Shared memory settings
$wgMainCacheType = CACHE_MEMCACHED;
$wgParserCacheType = CACHE_MEMCACHED; # optional
$wgMessageCacheType = CACHE_MEMCACHED; # optional
$wgMemCachedServers = ["127.0.0.1:11211"];
$wgSessionsInObjectCache = true; # optional
$wgSessionCacheType = CACHE_MEMCACHED; # optional

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = true;
$wgFileExtensions[] = 'svg';
$wgAllowTitlesInSVG = true;
$wgUseImageMagick = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";
$wgSVGConverter = 'rsvg';

# InstantCommons allows wiki to use images from https://commons.wikimedia.org
$wgUseInstantCommons = true;

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale
$wgShellLocale = "C.UTF-8";

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publically accessible from the web.
$wgCacheDirectory = "/opt/femiwiki/cache";
$wgUseFileCache = true;

# Site language code, should be one of the list in ./languages/data/Names.php
$wgLanguageCode = "ko";
$wgLocaltimezone = "Asia/Seoul";
date_default_timezone_set( $wgLocaltimezone );
$wgDefaultUserOptions['timecorrection'] = 9;

# Changing this will log out all existing sessions.
$wgAuthenticationTokenVersion = "1";

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'vector', 'monobook':
$wgDefaultSkin = "femiwiki";

# Enabled skins.
# The following skins were automatically enabled:
wfLoadSkin('Vector');
wfLoadSkin('Femiwiki');

# End of automatically generated settings.
# Add more configuration options below.

# Namespace settings
## BBS
define("NS_BBS", 3906);
define("NS_BBS_TALK", 3907);
$wgExtraNamespaces[NS_BBS] = "게시판";
$wgExtraNamespaces[NS_BBS_TALK] = "게시판토론";

## BBS (Legacy)
define("NS_BBSFREE", 3902);
define("NS_BBSFREE_TALK", 3903);
$wgExtraNamespaces[NS_BBSFREE] = "자유게시판";
$wgExtraNamespaces[NS_BBSFREE_TALK] = "자유게시판토론";
define("NS_BBSINTRO", 3904);
define("NS_BBSINTRO_TALK", 3905);
$wgExtraNamespaces[NS_BBSINTRO] = "가입인사게시판";
$wgExtraNamespaces[NS_BBSINTRO_TALK] = "가입인사게시판토론";

# Permission
$wgGroupPermissions['*']['createaccount'] = true;
$wgGroupPermissions['bureaucrat']['usermerge'] = true;
$wgGroupPermissions['bureaucrat']['renameuser'] = true;
$wgGroupPermissions['sysop']['deletelogentry'] = true;
$wgGroupPermissions['sysop']['deleterevision'] = true;
$wgGroupPermissions['sysop']['interwiki'] = true;

## Prevent anonymous users from edit pages
$wgGroupPermissions['*']['edit'] = false;

## Set when users become autoconfirmed users
$wgAutoConfirmCount = 0;
$wgAutoConfirmAge = 3600;

$wgAutopromote = [
    "autoconfirmed" => ["&",
        [APCOND_EDITCOUNT, &$wgAutoConfirmCount],
        [APCOND_AGE, &$wgAutoConfirmAge],
    ],
];

## Allow autoconfirmed users to edit pages
$wgGroupPermissions['user']['edit'] = false;
$wgGroupPermissions['autoconfirmed']['edit'] = true;
$wgGroupPermissions['seeder']['edit'] = true;
$wgGroupPermissions['bureaucrat']['edit'] = true;

## Add restricted-sysop group
$wgGroupPermissions['restricted-sysop'] = $wgGroupPermissions['sysop'];
$wgGroupPermissions['restricted-sysop']['apihighlimits'] = false;
$wgGroupPermissions['restricted-sysop']['deletelogentry'] = false;
$wgGroupPermissions['restricted-sysop']['deleterevision'] = false;
$wgGroupPermissions['restricted-sysop']['editinterface'] = false;
$wgGroupPermissions['restricted-sysop']['editusercss'] = false;
$wgGroupPermissions['restricted-sysop']['edituserjs'] = false;
$wgGroupPermissions['restricted-sysop']['managechangetags'] = false;
$wgGroupPermissions['restricted-sysop']['move-rootuserpages'] = false;
$wgGroupPermissions['restricted-sysop']['unblockself'] = false;

## But only seeders can edit major namespaces
//$wgNamespaceProtection[NS_MAIN] = ['edit-main'];
//$wgNamespaceProtection[NS_CATEGORY] = ['edit-main'];
//$wgNamespaceProtection[NS_HELP] = ['edit-main'];
//$wgNamespaceProtection[NS_PROJECT] = ['edit-main'];
//$wgNamespaceProtection[NS_TEMPLATE] = ['edit-main'];
//$wgNamespaceProtection[NS_BBSFREE] = ['edit-main'];
//$wgGroupPermissions['seeder']['edit-main'] = true;
//$wgGroupPermissions['bot']['edit-main'] = true;
//$wgGroupPermissions['bureaucrat']['edit-main'] = true;
//$wgGroupPermissions['sysop']['edit-main'] = true;

# Show numbers on headings
$wgDefaultUserOptions['numberheadings'] = 1;

# Hide some Preferences
$wgHiddenPrefs[] = 'gender';
$wgHiddenPrefs[] = 'realname';

# Allow display titles not only to titles that normalize to the same canonical DB key as the real page title.
$wgRestrictDisplayTitle = false;

# Open external links in new tab
$wgExternalLinkTarget = '_blank';

# Copyright
$wgRightsPage = "페미위키:저작권";
$wgRightsUrl = "https://creativecommons.org/licenses/by-sa/4.0/deed.ko";
$wgRightsText = "크리에이티브 커먼즈 저작자표시-동일조건변경허락 4.0 국제 라이선스";
$wgRightsIcon = "$wgResourceBasePath/resources/assets/licenses/cc-by-sa.png";

# User CSS and JS
$wgAllowUserCss = true;
$wgAllowUserJs = true;

# Allow external image link
$wgAllowExternalImages = true;
$wgAllowImageTag = true;

# all pages (that are not redirects) are considered as valid articles
$wgArticleCountMethod = 'any';

## Prevent Search for some namespaces
$wgNamespaceRobotPolicies = [
    NS_TALK => 'noindex,nofollow',
    NS_USER => 'noindex,nofollow',
    NS_USER_TALK => 'noindex,nofollow',
    NS_PROJECT_TALK => 'noindex,nofollow',
];
if ( defined( 'NS_TOPIC' ) ) $wgNamespaceRobotPolicies[NS_TOPIC] = 'noindex,nofollow';

# Provide Naspace Aliases
$wgNamespaceAliases = [
    '도' => NS_HELP,
    '페' => NS_PROJECT
];

# Parsoid server Setting
$wgVirtualRestConfig['modules']['parsoid'] = [
    'url' => 'PROTOCOL://PARSOID',
    'domain' => 'HOST',
    'prefix' => 'HOST'
];

# Plugins
## ParserFunction
wfLoadExtension( 'ParserFunctions' );
$wgPFEnableStringFunctions = true;

## AWS is activate only in production mode
if ( 'HOST' == 'femiwiki.com' ) {
    wfLoadExtension( 'AWS' );
    $wgAWSRegion = 'ap-northeast-1';
    $wgAWSBucketPrefix = "femiwiki-uploaded-files";
    $wgAWSRepoHashLevels = 2;
}

## VisualEditor
wfLoadExtension( 'VisualEditor' );
$wgVisualEditorAvailableNamespaces = [
    NS_SPECIAL => true,
    NS_MAIN => true,
    NS_TALK => true,
    NS_USER => true,
    NS_USER_TALK => true,
    NS_PROJECT => true,
    NS_PROJECT_TALK => true,
    NS_FILE => true,
    NS_FILE_TALK => true,
    NS_MEDIAWIKI => true,
    NS_MEDIAWIKI_TALK => true,
    NS_TEMPLATE => true,
    NS_TEMPLATE_TALK => true,
    NS_HELP => true,
    NS_HELP_TALK => true,
    NS_CATEGORY => true,
    NS_CATEGORY_TALK => true,
    "_merge_strategy" => "array_plus",
];

# Enable Visual Editor to opt-out
$wgDefaultUserOptions['visualeditor-enable'] = 1;
$wgHiddenPrefs[] = 'visualeditor-enable';
$wgDefaultUserOptions['visualeditor-enable-experimental'] = 1;
$wgVisualEditorSupportedSkins[] = 'femiwiki';

# Enable 2017 Wikitext Editor to opt-in
$wgVisualEditorEnableWikitext = true;

# Enable Visual diffs on history pages
$wgVisualEditorEnableDiffPage = true;

# Enable Single Edit Tab to opt-in
$wgVisualEditorUseSingleEditTab = true;
$wgDefaultUserOptions['visualeditor-tabs'] = 'multi-tab';

# Enable twocolconflict to opt-out
$wgDefaultUserOptions['twocolconflict'] = true;

# This feature requires a non-locking session store. The default session store will not work and
# will cause deadlocks (connection timeouts from Parsoid) when trying to use this feature. Only required for MediaWiki 1.26.x and earlier!
$wgSessionsInObjectCache = true;
# Forward users' Cookie: headers to Parsoid. Required for private wikis (login required to read).
# If the wiki is not private (i.e. $wgGroupPermissions['*']['read'] is true) this configuration
# variable will be ignored.
$wgVirtualRestConfig['modules']['parsoid']['forwardCookies'] = true;

## TemplateData
wfLoadExtension( 'TemplateData' );

## RevisionSlider
wfLoadExtension( 'RevisionSlider' );

## Echo
wfLoadExtension( 'Echo' );

## TwoColConflict
wfLoadExtension( 'TwoColConflict' );
$wgDefaultUserOptions['twocolconft'] = true;

## Interwiki
wfLoadExtension( 'Interwiki' );

## Thanks
wfLoadExtension('Thanks');

## Scribunto
wfLoadExtension( 'Scribunto' );
$wgScribuntoDefaultEngine = 'luastandalone';

## Flow

wfLoadExtension( 'Flow' );
$wgFlowEditorList = ['visualeditor', 'none'];
$wgFlowContentFormat = 'html';
$wgNamespaceContentModels[NS_TALK] = 'flow-board';
$wgNamespaceContentModels[NS_USER_TALK] = 'flow-board';
$wgNamespaceContentModels[NS_PROJECT_TALK] = 'flow-board';
$wgNamespaceContentModels[NS_FILE_TALK] = 'flow-board';
$wgNamespaceContentModels[NS_MEDIAWIKI_TALK] = 'flow-board';
$wgNamespaceContentModels[NS_TEMPLATE_TALK] = 'flow-board';
$wgNamespaceContentModels[NS_HELP_TALK] = 'flow-board';
$wgNamespaceContentModels[NS_CATEGORY_TALK] = 'flow-board';
if ( defined( 'NS_MODULE_TALK' ) ) $wgNamespaceContentModels[NS_MODULE_TALK] = 'flow-board';
$wgNamespaceContentModels[NS_BBS] = 'flow-board';
$wgNamespaceContentModels[NS_BBS_TALK] = 'flow-board';

## TemplateStyles
wfLoadExtension( 'TemplateStyles' );

## CategoryTree
wfLoadExtension( 'CategoryTree' );

## Disambiguator
wfLoadExtension( 'Disambiguator' );

## Cite
wfLoadExtension('Cite');

## CodeEditor
wfLoadExtension('CodeEditor');

## WikiEditor
wfLoadExtension('WikiEditor');
$wgDefaultUserOptions['usebetatoolbar'] = 1;
$wgDefaultUserOptions['usebetatoolbar-cgd'] = 1;
$wgDefaultUserOptions['wikieditor-preview'] = 1;
$wgDefaultUserOptions['wikieditor-publish'] = 1;

## AbuseFilter
wfLoadExtension( 'AbuseFilter' );
$wgGroupPermissions['sysop']['abusefilter-modify'] = true;
$wgGroupPermissions['*']['abusefilter-log-detail'] = true;
$wgGroupPermissions['*']['abusefilter-view'] = true;
$wgGroupPermissions['*']['abusefilter-log'] = true;
$wgGroupPermissions['sysop']['abusefilter-private'] = true;
$wgGroupPermissions['sysop']['abusefilter-modify-restricted'] = true;
$wgGroupPermissions['sysop']['abusefilter-revert'] = true;

## CheckUser
wfLoadExtension( 'CheckUser' );

## UserMerge
wfLoadExtension('UserMerge');

## Renameuser
wfLoadExtension( 'Renameuser' );

## EmbedVideo
wfLoadExtension('EmbedVideo');

## Description2
wfLoadExtension( 'Description2' );

## OpenGraphMeta
wfLoadExtension( 'OpenGraphMeta' );

## PageImages
wfLoadExtension( 'PageImages' );

## FacetedCategory
wfLoadExtension( 'FacetedCategory' );

## ExtendedSpecialPagesForFemiwiki --it needs the CategoryTree
wfLoadExtension( 'UnifiedExtensionForFemiwiki' );
$wgSpecialPages['Uncategorizedcategories'] = [SpecialUncategorizedCategoryTree::class];
$wgSpecialPages['Whatlinkshere'] = [SpecialOrderedWhatlinkshere::class];

## IntersectionSearch
wfLoadExtension( 'CategoryIntersectionSearch' );

## SimpleMathJax
wfLoadExtension( 'SimpleMathJax' );

## HTMLTags
require_once "$IP/extensions/HTMLTags/HTMLTags.php";
$wgHTMLTagsAttributes['a'] = ['href', 'class', 'itemprop'];
$wgHTMLTagsAttributes['link'] = ['href', 'itemprop'];
$wgHTMLTagsAttributes['meta'] = ['content', 'itemprop'];
$wgHTMLTagsAttributes['iframe'] = ['src', 'class', 'style'];

## Sanction
wfLoadExtension( 'Sanctions' );

## BetaFeatures
wfLoadExtension( 'BetaFeatures' );

# Misc.
$wgShowExceptionDetails = ('HOST' != 'femiwiki.com');
$wgDebugToolbar = ('HOST' != 'femiwiki.com');

require_once "/opt/femiwiki/LocalSettingsSecure.php";
