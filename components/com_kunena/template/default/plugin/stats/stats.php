<?php
/**
* @version $Id$
* Kunena Component
* @package Kunena
*
* @Copyright (C) 2008 - 2009 Kunena Team All rights reserved
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @link http://www.kunena.com
*
* Based on FireBoard Component
* @Copyright (C) 2006 - 2007 Best Of Joomla All rights reserved
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @link http://www.bestofjoomla.com
*
* Based on Joomlaboard Component
* @copyright (C) 2000 - 2004 TSMF / Jan de Graaff / All Rights Reserved
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @author TSMF & Jan de Graaff
**/

// Dont allow direct linking
defined( '_JEXEC' ) or die();


$kunena_config =& CKunenaConfig::getInstance();
$document =& JFactory::getDocument();

$document->setTitle(_STAT_FORUMSTATS . ' - ' . stripslashes($kunena_config->board_title));

if($kunena_config->showstats):

$this->loadGenStats();
$this->loadUserStats();
$this->loadTopicStats();
$this->loadPollStats();

$forumurl = 'index.php?option=com_kunena';

if ($kunena_config->fb_profile == "jomsocial")
{
	$userlist = JRoute::_('index.php?option=com_community&amp;view=search&amp;task=browse');
}
else if ($kunena_config->fb_profile == 'cb')
{
    $userlist = CKunenaCBProfile::getUserListURL();
}
else
{
    $userlist = JRoute::_(KUNENA_LIVEURLREL . '&amp;func=userlist');
}

?>

        <!-- BEGIN: GENERAL STATS -->
<?php if($kunena_config->showgenstats): ?>
<div class="fb__bt_cvr1">
<div class="fb__bt_cvr2">
<div class="fb__bt_cvr3">
<div class="fb__bt_cvr4">
<div class="fb__bt_cvr5">
        <table  class = "fb_blocktable" id ="fb_morestat" border = "0" cellspacing = "0" cellpadding = "0" width="100%">
            <thead>
                <tr>
                    <th>
                        <div class = "fb_title_cover fbm">
                            <span class="fb_title fbl"><?php echo stripslashes($kunena_config->board_title); ?> <?php echo _STAT_FORUMSTATS; ?></span>
                        </div>
                        <img id = "BoxSwitch__morestat_tbody" class = "hideshow" src = "<?php echo KUNENA_URLIMAGESPATH . 'shrink.gif' ; ?>" alt = ""/>
                    </th>
                </tr>
            </thead>

            <tbody id = "morestat_tbody">
                <tr class = "fb_sth fbs">
                    <th class = "th-1 fb_sectiontableheader" align="left" width="50%"><?php echo _STAT_GENERAL_STATS; ?>
                    </th>
                </tr>

                <tr class = "fb_sectiontableentry1">
                    <td class = "td-1" align="left">
<?php echo _STAT_TOTAL_USERS; ?>:<b> <a href = "<?php echo $userlist;?>"><?php echo $this->totalmembers; ?></a> </b>
                    &nbsp; <?php echo _STAT_LATEST_MEMBERS; ?>:<b> <?php echo CKunenaLink::GetProfileLink($kunena_config, $this->lastestmemberid, $this->lastestmember); ?></b>

                <br/> <?php echo _STAT_TOTAL_MESSAGES; ?>: <b> <?php echo $this->totalmsgs; ?></b> &nbsp;
    <?php echo _STAT_TOTAL_SUBJECTS; ?>: <b> <?php echo $this->totaltitles; ?></b> &nbsp; <?php echo _STAT_TOTAL_SECTIONS; ?>: <b> <?php echo $this->totalcats; ?></b> &nbsp; <?php echo _STAT_TOTAL_CATEGORIES; ?>: <b> <?php echo $this->totalsections; ?></b>

                <br/> <?php echo _STAT_TODAY_OPEN_THREAD; ?>: <b> <?php echo $this->todayopen; ?></b> &nbsp; <?php echo
    _STAT_YESTERDAY_OPEN_THREAD; ?>: <b> <?php echo $this->yesterdayopen; ?></b> &nbsp; <?php echo _STAT_TODAY_TOTAL_ANSWER; ?>: <b> <?php echo $this->todayanswer; ?></b> &nbsp; <?php echo _STAT_YESTERDAY_TOTAL_ANSWER; ?>: <b> <?php echo $this->yesterdayanswer; ?></b>

                    </td>
                </tr>
            </tbody>
        </table>
        </div>
</div>
</div>
</div>
</div>
<?php endif; ?>
<!-- FINISH: GENERAL STATS -->

<?php
$tabclass = array
(
"sectiontableentry1",
"sectiontableentry2"
);
$k = 0;
?>


<!-- B: Pop Subject -->
<?php if($this->showpopsubjectstats): ?>
<div class="fb__bt_cvr1">
<div class="fb__bt_cvr2">
<div class="fb__bt_cvr3">
<div class="fb__bt_cvr4">
<div class="fb__bt_cvr5">
<table class = "fb_blocktable " id="fb_popsubmorestat"  cellpadding = "0" cellspacing = "0" border = "0" width = "100%">
  <thead>
    <tr>
      <th colspan="3">
      <div class = "fb_title_cover fbm"> <span class="fb_title fbl"><?php echo _STAT_TOP; ?> <strong><?php echo $kunena_config->popsubjectcount; ?></strong> <?php echo _STAT_POPULAR; ?> <?php echo _STAT_POPULAR_USER_KGSG; ?></span> </div>
      <img id = "BoxSwitch__fb_popsubstats_tbody" class = "hideshow" src = "<?php echo KUNENA_URLIMAGESPATH . 'shrink.gif' ; ?>" alt = ""/>
      </th>
    </tr>
  </thead>
  <tbody id = "fb_popsubstats_tbody">
   <tr  class = "fb_sth" >
      <th class = "th-1 fb_sectiontableheader" align="left" width="50%"> <?php echo _GEN_SUBJECT ;?></th>
      <th class = "th-2 fb_sectiontableheader" width="40%">&nbsp;  </th>
      <th class = "th-3 fb_sectiontableheader" align="center" width="10%"></th>
    </tr>
 <?php foreach ($this->toptitles as $toptitle)
       {
	   $k = 1 - $k;
		   if ($toptitle->hits == $this->toptitlehits) {
		   $barwidth = 100;
		   }
		   else {
		   $barwidth = round(($toptitle->hits * 100) / $this->toptitlehits);
		   }
	  $link = JRoute::_(KUNENA_LIVEURLREL . '&amp;func=view&amp;id=' . $toptitle->id . '&amp;catid=' . $toptitle->catid);
?>

    <tr class = "fb_<?php echo $tabclass[$k]; ?>">
      <td class="td-1" align="left">
       <a href = "<?php echo $link;?>"><?php echo kunena_htmlspecialchars(stripslashes($toptitle->subject)); ?></a>
      </td>
      <td  class="td-2">
       <img class = "jr-forum-stat-bar" src = "<?php echo KUNENA_TMPLTMAINIMGURL.'/images/bar.gif';?>" alt = "" height = "10" width = "<?php echo $barwidth;?>%"/>
      </td>
      <td  class="td-3">
	  <?php echo $toptitle->hits; ?> <?php echo _KUNENA_USRL_HITS ;?>
       </td>
    </tr>
<?php }   ?>
  </tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<?php endif; ?>
<!-- F: Pop Subject -->


<!-- B: Pop Poll -->
<?php if($this->showpoppollstats): ?>
<div class="fb__bt_cvr1">
<div class="fb__bt_cvr2">
<div class="fb__bt_cvr3">
<div class="fb__bt_cvr4">
<div class="fb__bt_cvr5">
<table class = "fb_blocktable " id="fb_popsubmorestat"  cellpadding = "0" cellspacing = "0" border = "0" width = "100%">
  <thead>
    <tr>
      <th colspan="3">
      <div class = "fb_title_cover fbm"> <span class="fb_title fbl"><?php echo _STAT_TOP; ?> <strong><?php echo $kunena_config->poppollscount; ?></strong> <?php echo _STAT_POPULAR; ?> <?php echo _STAT_POPULAR_POLLS_KGSG; ?></span> </div>
      <img id = "BoxSwitch__fb_popsubstats_tbody" class = "hideshow" src = "<?php echo KUNENA_URLIMAGESPATH . 'shrink.gif' ; ?>" alt = ""/>
      </th>
    </tr>
  </thead>
  <tbody id = "fb_popsubstats_tbody">
   <tr  class = "fb_sth" >
      <th class = "th-1 fb_sectiontableheader" align="left" width="50%"> <?php echo _KUNENA_POLL_NAME;?></th>
      <th class = "th-2 fb_sectiontableheader" width="40%">&nbsp;  </th>
      <th class = "th-3 fb_sectiontableheader" align="center" width="10%"></th>
    </tr>
 <?php foreach($this->toppolls as $toppoll)
       {
       if($toppoll->total != "0")
       {
	   $k = 1 - $k;
		   if ($toppoll->total == $this->toppollvotes) {
          $barwidth = 100;
		   }
		   else {
		    if($toppoll->total== null){
          $toppoll->total = "0";
        }
		    $barwidth = round(($toppoll->total * 100) / $this->toppollvotes);
		   }
	  $link = JRoute::_(KUNENA_LIVEURLREL . '&amp;func=view&amp;id=' . $toppoll->threadid . '&amp;catid=' . $toppoll->catid);
?>

    <tr class = "fb_<?php echo $tabclass[$k]; ?>">
      <td class="td-1" align="left">
       <a href = "<?php echo $link;?>"><?php echo kunena_htmlspecialchars(stripslashes($toppoll->title)); ?></a>
      </td>
      <td  class="td-2">
       <img class = "jr-forum-stat-bar" src = "<?php echo KUNENA_TMPLTMAINIMGURL.'/images/bar.gif';?>" alt = "" height = "10" width = "<?php echo $barwidth;?>%"/>
      </td>
      <td  class="td-3">
	  <?php echo $toppoll->total; ?> <?php echo _KUNENA_USRL_VOTES ;?>
       </td>
    </tr>
<?php }
}  ?>
  </tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<?php endif; ?>
<!-- F: Pop Polls -->


<!-- B: User Messages -->
<?php if($this->showpopuserstats): ?>
<div class="fb__bt_cvr1">
<div class="fb__bt_cvr2">
<div class="fb__bt_cvr3">
<div class="fb__bt_cvr4">
<div class="fb__bt_cvr5">
<table class = "fb_blocktable " id="fb_popusermsgmorestat"  cellpadding = "0" cellspacing = "0" border = "0" width = "100%">
  <thead>
    <tr>
      <th colspan="3">
      <div class = "fb_title_cover fbm"> <span class="fb_title fbl"><?php echo _STAT_TOP; ?> <strong><?php echo $kunena_config->popusercount; ?></strong> <?php echo _STAT_POPULAR; ?> <?php echo _STAT_POPULAR_USER_TMSG; ?></span></div>
      <img id = "BoxSwitch__fb_popusermsgstats_tbody" class = "hideshow" src = "<?php echo KUNENA_URLIMAGESPATH . 'shrink.gif' ; ?>" alt = ""/>
      </th>
    </tr>
  </thead>
  <tbody id = "fb_popusermsgstats_tbody">
   <tr  class = "fb_sth" >
      <th class = "th-1 fb_sectiontableheader" align="left" width="50%"><?php echo _KUNENA_USRL_USERNAME ;?></th>
      <th class = "th-2 fb_sectiontableheader" width="40%">&nbsp;  </th>
      <th class = "th-3 fb_sectiontableheader" align="center" width="10%"></th>
    </tr>
<?php

	foreach ($this->topposters as $poster)
	{

	$k = 1 - $k;

	if ($poster->posts == $this->topmessage) {
	$barwidth = 100;
	}
	else {
	$barwidth = round(($poster->posts * 100) / $this->topmessage);
	}
?>

    <tr class = "fb_<?php echo $tabclass[$k]; ?>">
      <td  class="td-1"  align="left">

         <?php echo CKunenaLink::GetProfileLink($kunena_config, $poster->userid, $poster->username); ?>

</td>
      <td  class="td-2">
         <img class = "jr-forum-stat-bar" src = "<?php echo KUNENA_TMPLTMAINIMGURL.'/images/bar.gif';?>" alt = "" height = "10" width = "<?php echo $barwidth;?>%"/>
                                    </td>
      <td  class="td-3">
	  <?php echo $poster->posts; ?> <?php echo _KUNENA_USRL_POSTS ;?>
       </td>
    </tr>
<?php }   ?>
  </tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<?php endif; ?>
<!-- F: User Messages -->


<!-- B: Pop User  -->
<?php if($this->showpopuserstats): ?>
<div class="fb__bt_cvr1">
<div class="fb__bt_cvr2">
<div class="fb__bt_cvr3">
<div class="fb__bt_cvr4">
<div class="fb__bt_cvr5">
<table class = "fb_blocktable " id="fb_popuserhitmorestat"  cellpadding = "0" cellspacing = "0" border = "0" width = "100%">
  <thead>
    <tr>
      <th colspan="3">
      <div class = "fb_title_cover fbm"> <span class="fb_title fbl"><?php echo _STAT_TOP; ?> <strong><?php echo $kunena_config->popusercount; ?></strong> <?php echo _STAT_POPULAR; ?> <?php echo _STAT_POPULAR_USER_GSG; ?></span> </div>
      <img id = "BoxSwitch__fb_popuserhitstats_tbody" class = "hideshow" src = "<?php echo KUNENA_URLIMAGESPATH . 'shrink.gif' ; ?>" alt = ""/>
      </th>
    </tr>
  </thead>
  <tbody id = "fb_popuserhitstats_tbody">
   <tr  class = "fb_sth fbs" >
      <th class = "th-1 fb_sectiontableheader"  align="left" width="50%"> <?php echo _KUNENA_USRL_USERNAME ;?></th>
      <th class = "th-2 fb_sectiontableheader" width="40%">&nbsp;  </th>
      <th class = "th-3 fb_sectiontableheader" align="center" width="10%"></th>
    </tr>

<?php
foreach ($this->topprofiles as $topprofile)
{
$k = 1 - $k;
if ($topprofile->hits == $this->topprofilehits) {
$barwidth = 100;
}
else {
$barwidth = round(($topprofile->hits * 100) / $this->topprofilehits);
}
?>

    <tr class = "fb_<?php echo $tabclass[$k]; ?>">
      <td  class="td-1"  align="left">
        <?php echo CKunenaLink::GetProfileLink($kunena_config, $topprofile->user_id, $topprofile->user); ?>
</td>
      <td  class="td-2">
         <img class = "jr-forum-stat-bar" src = "<?php echo KUNENA_TMPLTMAINIMGURL.'/images/bar.gif';?>" alt = "" height = "10" width = "<?php echo $barwidth;?>%"/>
                                    </td>
      <td  class="td-3">
	  <?php echo $topprofile->hits; ?> <?php echo _KUNENA_USRL_HITS ;?>
       </td>
    </tr>
<?php }   ?>
  </tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<?php endif; ?>
<!-- F: User User -->


<?php
//(FB) BEGIN: WHOISONLINE
if (file_exists(KUNENA_ABSTMPLTPATH . '/plugin/who/whoisonline.php')) {
    include(KUNENA_ABSTMPLTPATH . '/plugin/who/whoisonline.php');
}
else {
    include(KUNENA_PATH_TEMPLATE_DEFAULT .DS. 'plugin/who/whoisonline.php');
}

//(FB) FINISH: WHOISONLINE

endif;
