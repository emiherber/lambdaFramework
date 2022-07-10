<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $view->headTitulo; ?></title>
        <?php require_once 'bundles/_bundleStyles.php'; ?>
    </head>
    <body>
        <div id="q-app">
            <q-layout view="lhh LpR lFf" container style="height: 100vh">
                <q-page-container>
                    <q-page padding>
                        <?= $view->buffer ?>
                    </q-page>
                </q-page-container>
            </q-layout>
        </div>
        <?php require_once 'bundles/_bundleScripts.php';?>
    </body>
</html>