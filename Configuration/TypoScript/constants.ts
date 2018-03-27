##
## plugin.tx_t3quotes_t3quotes
## Available themes: Default, Bootstrap, Classic, Development
##
plugin.tx_t3quotes_t3quotes {
  view {
    # cat=plugin.tx_t3quotes_t3quotes/file; type=string; label=Path to template root (FE)
    templateRootPath = EXT:t3quotes/Resources/Private/Themes/Default/Templates/
    # cat=plugin.tx_t3quotes_t3quotes/file; type=string; label=Path to template partials (FE)
    partialRootPath = EXT:t3quotes/Resources/Private/Themes/Default/Partials/
    # cat=plugin.tx_t3quotes_t3quotes/file; type=string; label=Path to template layouts (FE)
    layoutRootPath = EXT:t3quotes/Resources/Private/Themes/Default/Layouts/
    layoutRootPath.insertData = 1
  }
  persistence {
    # cat=plugin.tx_t3quotes_t3quotes//a; type=string; label=Default storage PID
    storagePid =
  }
}
