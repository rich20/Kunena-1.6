<?php
/**
 * @version $Id$
 * Kunena Component
 * @package Kunena
 *
 * @Copyright (C) 2008 - 2010 Kunena Team All rights reserved
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

$kunena_app = & JFactory::getApplication ();

global $kunena_icons;
?>

<script type="text/javascript">
        jQuery(function()
        {
            jQuery(".kqr_fire").click(function()
            {
                jQuery("#sc" + (jQuery(this).attr("id").split("__")[1])).toggle();
            });
            jQuery(".kqm_cncl_btn").click(function()
            {
                jQuery("#sc" + (jQuery(this).attr("id").split("__")[1])).toggle();
            });

        });
        </script>

<div><?php $this->displayPathway(); ?></div>
<?php
		if ($this->headerdesc) {
			?>
<table
	class="kforum-headerdesc<?php
			echo isset ( $this->catinfo->class_sfx ) ? ' kforum-headerdesc' . $this->catinfo->class_sfx : '';
			?>"
	border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td><?php
			echo $this->headerdesc;
			?>
		</td>
	</tr>
</table>
<?php
		}
		$this->displayPoll();
		CKunenaTools::showModulePosition( 'kunena_poll' );
		$this->displayThreadActions();
?>

<table
	class="kblocktable<?php
		echo isset ( $this->catinfo->class_sfx ) ? ' kblocktable' . $this->catinfo->class_sfx : '';
		?>"
	id="kviews" cellpadding="0" cellspacing="0" border="0" width="100%">
	<thead>
		<tr>
			<th align="left">
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr>
					<td>

					<div class="ktitle_cover  km"><span class="ktitle kl"><?php
		echo _KUNENA_TOPIC;
		?>
		<?php
		echo $this->kunena_topic_title;
		?>
		</span>

		<!-- Begin: Total Favorite -->
			<?php
		echo '<div class="ktotalfavorite">';
		if ($kunena_icons ['favoritestar']) {
			if ($this->favorited)
				echo '<img src="' . KUNENA_URLICONSPATH . $kunena_icons ['favoritestar'] . '" alt="*" border="0" title="' . _KUNENA_FAVORITE . '" />';
			else if ($this->totalfavorited)
				echo '<img src="' . KUNENA_URLICONSPATH . $kunena_icons ['favoritestar_grey'] . '" alt="*" border="0" title="' . _KUNENA_FAVORITE . '" />';
		} else {
			echo _KUNENA_TOTALFAVORITE;
			echo $this->totalfavorited;
		}
		echo '</div>';
		?>
	<!-- Finish: Total Favorite -->

					</div>
					</td>
				</tr>
			</table>
			<?php
		//(JJ) FINISH: RECENT POSTS
		?></th>
		</tr>
	</thead>

	<tr>
		<td><?php
		foreach ( $this->flat_messages as $message ) {
			$this->displayMessage($message);
		}
		?>
		</td>
	</tr>
</table>

<?php $this->displayThreadActions(); ?>
<div class = "kforum-pathway-bottom">
	<?php echo $this->kunena_pathway1; ?>
</div>
<!-- F: List Actions Bottom -->

<!-- B: Category List Bottom -->
<table class="klist_bottom" border="0" cellspacing="0" cellpadding="0"
	width="100%">
	<tr>
		<td class="klist_moderators">
		<!-- Mod List -->
		<?php
		if (count ( $this->modslist ) > 0) {
		?>
		<div class="kbox-bottomarea-modlist">
		<?php
			echo '' . _GEN_MODERATORS . ": ";
			$modlinks = array();
			foreach ( $this->modslist as $mod ) {
				$modlinks[] = CKunenaLink::GetProfileLink ( $this->config, $mod->userid, ($this->config->username ? $mod->username : $mod->name) );
			}
			echo implode(', ', $modlinks);
		?>
		</div>
		<?php
		}
		?>
		<!-- /Mod List -->
		</td>
		<td class="klist_categories">
		<?php $this->displayForumJump();
		?>
		</td>
	</tr>
</table>
<!-- F: Category List Bottom -->

<?php

if ($this->config->highlightcode) {
	echo '
	<script type="text/javascript" src="' . KUNENA_DIRECTURL . '/template/default/plugin/chili/jquery.chili-2.2.js"></script>
	<script id="setup" type="text/javascript">
	ChiliBook.recipeFolder     = "' . KUNENA_DIRECTURL . '/template/default/plugin/chili/";
	ChiliBook.stylesheetFolder     = "' . KUNENA_DIRECTURL . '/template/default/plugin/chili/";
	</script>
	';
}

?>