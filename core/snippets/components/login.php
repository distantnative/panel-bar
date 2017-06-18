<a href="<?= $site->url() ?>/panel" class="panelBar-login" title="<?= l::get('panelBar.login'); ?>">
  <img src="<?= url('assets/plugins/panel-bar/images/signin.svg') ?>" alt="<?= l::get('panelBar.login'); ?>" width="15" height="15" />
</a>
<style>
  .panelBar-login {
    display:   block;
    position:  fixed;
    bottom:    12px;
    right:     17px;
    font-size: 15px;
    border:    none;
    color:     #000;
  }

  .panelBar-login:hover {
    opacity: .75;
    cursor:  pointer;
  }

  .panelBar-login > img {
    width: 15px
  }
</style>
