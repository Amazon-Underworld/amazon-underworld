
<form action="" class="advanced-search">
    <label name="Search"><?=_e('Search', 'hacklabr');?></label>
    <input type="text" placeholder="<?=_e('Type your search', 'hacklabr');?>" name="s" value="<?= isset($_GET['s']) ? $_GET['s'] : '' ?>">
    <button type="submit"><img src="<?= get_template_directory_uri() ?>/assets/images/search-icon.svg" alt="Search"></button>
</form>