<?php
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
sendVarToJS('eqType', 'blink1');
$eqLogics = eqLogic::byType('blink1');
sendVarToJS('wathUrl', network::getNetworkAccess('external') . '/plugins/blink1/core/php/watch.php?apikey=' . config::byKey('api'));
?>

<div class="row row-overflow">
    <div class="col-lg-2 col-md-3 col-sm-4">
        <div class="bs-sidebar">
            <ul id="ul_eqLogic" class="nav nav-list bs-sidenav">
                <a class="btn btn-default eqLogicAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter une blink(1)}}</a>
                <li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
                <?php
foreach ($eqLogics as $eqLogic) {
	echo '<li class="cursor li_eqLogic" data-eqLogic_id="' . $eqLogic->getId() . '"><a>' . $eqLogic->getHumanName(true) . '</a></li>';
}
?>
           </ul>
       </div>
   </div>
   <div class="col-lg-10 col-md-9 col-sm-8 eqLogicThumbnailDisplay" style="border-left: solid 1px #EEE; padding-left: 25px;">
   <legend><i class="fa fa-cog"></i>  {{Gestion}}</legend>
   <div class="eqLogicThumbnailContainer">
    <div class="cursor eqLogicAction" data-action="add" style="text-align: center; background-color : #ffffff; height : 140px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;" >
            <i class="fa fa-plus-circle" style="font-size : 6em;color:#94ca02;"></i>
        <br>
        <span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;color:#94ca02">Ajouter</span>
    </div>
  <div class="cursor eqLogicAction" data-action="gotoPluginConf" style="text-align: center; background-color : #ffffff; height : 140px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;">
      <i class="fa fa-wrench" style="font-size : 6em;color:#767676;"></i>
    <br>
    <span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;color:#767676">{{Configuration}}</span>
  </div>
</div>
    <legend><i class="icon jeedom-alerte2"></i>  {{Mes clés blink(1)}}
    </legend>

    <div class="eqLogicThumbnailContainer">
    <?php
foreach ($eqLogics as $eqLogic) {
	$opacity = '';
	if ($eqLogic->getIsEnable() != 1) {
		$opacity = 'opacity:0.3;';
	}
	echo '<div class="eqLogicDisplayCard cursor" data-eqLogic_id="' . $eqLogic->getId() . '" style="text-align: center; background-color : #ffffff; height : 200px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;' . $opacity . '" >';
	echo '<img src="plugins/blink1/doc/images/blink1_icon.png" height="105" width="95" />';
	echo "<br>";
	echo '<span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space:text-align: center;  pre-wrap;word-wrap: break-word;">' . $eqLogic->getHumanName(true, true) . '</span>';
	echo '</div>';
}
?>
</div>
</div>
<div class="col-lg-10 col-md-9 col-sm-8 eqLogic" style="border-left: solid 1px #EEE; padding-left: 25px;display: none;">
<a class="btn btn-success eqLogicAction pull-right" data-action="save"><i class="fa fa-check-circle"></i> {{Sauvegarder}}</a>
  <a class="btn btn-danger eqLogicAction pull-right" data-action="remove"><i class="fa fa-minus-circle"></i> {{Supprimer}}</a>
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#eqlogictab" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-tachometer"></i> {{Equipement}}</a></li>
    <li role="presentation"><a href="#commandtab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i> {{Commandes}}</a></li>
  </ul>
  <div class="tab-content" style="height:calc(100% - 50px);overflow:auto;overflow-x: hidden;">
    <div role="tabpanel" class="tab-pane active" id="eqlogictab">
    <div class="row">
       <div class="col-sm-6" >
        <form class="form-horizontal">
            <fieldset>
                <legend><i class="fa fa-arrow-circle-left eqLogicAction cursor" data-action="returnToThumbnailDisplay"></i> {{Général}}  <i class='fa fa-cogs eqLogicAction pull-right cursor expertModeVisible' data-action='configure'></i></legend>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{Nom de l'équipement blink(1)}}</label>
                    <div class="col-sm-6">
                        <input type="text" class="eqLogicAttr form-control" data-l1key="id" style="display : none;" />
                        <input type="text" class="eqLogicAttr form-control" data-l1key="name" placeholder="{{Nom de l'équipement blink(1)}}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" >{{Objet parent}}</label>
                    <div class="col-sm-6">
                        <select id="sel_object" class="eqLogicAttr form-control" data-l1key="object_id">
                            <option value="">{{Aucun}}</option>
                            <?php
foreach (object::all() as $object) {
	echo '<option value="' . $object->getId() . '">' . $object->getName() . '</option>';
}
?>
                       </select>
                   </div>
               </div>
               <div class="form-group">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-9">
                  <label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isEnable" checked/>{{Activer}}</label>
                  <label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isVisible" checked/>{{Visible}}</label>
                </div>
              </div>
         <div class="form-group">
            <label class="col-sm-3 control-label">{{Mode}}</label>
            <div class="col-sm-6">
                <select type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="mode">
                   <option value="both">{{Les deux}}</option>
                   <option value="internal">{{Appels à l'API blink(1)}}</option>
                   <option value="watch">{{Surveillance par URL}}</option>
                   <option value="ssh">{{SSH}}</option>
                   <option value="local">{{Local}}</option>
               </select>
           </div>
       </div>

   </fieldset>
</form>
</div>
<div class="col-sm-6" >
   <legend><i class="fa fa-wrench"></i>  {{Configuration}}</legend>
   <form class="form-horizontal">
    <fieldset>
     <div class="form-group mode ssh local expertModeVisible">
        <label class="col-sm-3 control-label">{{Numéro de périphérique}}</label>
        <div class="col-sm-6">
            <input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="device" title="{{Laisser vide pour utiliser le premier blink(1) trouvé}}"/>
        </div>
    </div>
     <div class="form-group mode both internal">
        <label class="col-sm-3 control-label">{{Adresse ou IP}}</label>
        <div class="col-sm-6">
            <input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="address"/>
        </div>
    </div>
    <div class="form-group mode both internal">
        <label class="col-sm-3 control-label">{{Port}}</label>
        <div class="col-sm-6">
            <input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="port"/>
        </div>
    </div>
    <div class="form-group mode ssh">
        <label class="col-sm-3 control-label">{{Adresse ou IP}}</label>
        <div class="col-sm-6">
            <input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="host"/>
        </div>
    </div>
    <div class="form-group mode ssh">
        <label class="col-sm-3 control-label">{{Nom d'utilisateur}}</label>
        <div class="col-sm-6">
            <input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="username"/>
        </div>
    </div>
    <div class="form-group mode ssh">
        <label class="col-sm-3 control-label">{{Chemin relatif de l'exécutable blink1-tool}}</label>
        <div class="col-sm-6">
            <input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="pathtoblink1" value="./blink1-tool"/>
        </div>
    </div>
    <div class="form-group mode both watch">
        <label class="col-sm-3 control-label">{{Ne pas répéter les commandes}}</label>
        <div class="col-sm-3">
			<input type="checkbox" class="eqLogicAttr" data-l1key="configuration" data-l2key="doNoRepeatCommand"/>
        </div>
    </div>
    <div class="form-group mode both internal">
        <label class="col-sm-3 control-label">{{Pattern}}</label>
        <div class="col-sm-3">
            <a class="btn btn-default" id="bt_syncPattern"><i class="fa fa-exchange"></i> {{Synchroniser}}</a>
        </div>
    </div>
</fieldset>
</form>
</div>
</div>
<form class="form-horizontal  mode both watch">
    <fieldset>
      <div class="form-group">
        <label class="col-lg-3 control-label">{{URL à surveiller}}</label>
        <div class="col-lg-9">
            <span id="span_watchUrl"></span>
        </div>
    </div>
</fieldset>
</form>
</div>

<div role="tabpanel" class="tab-pane" id="commandtab">

<a class="btn btn-success btn-sm cmdAction pull-right" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter une commande}}</a><br/><br/>
  <table id="table_cmd" class="table table-bordered table-condensed">
    <thead>
        <tr>
            <th style="width : 300px;">{{Nom}}</th>
            <th style="width : 200px;">{{Type}}</th>
            <th>{{Paramètres}}</th>
            <th>{{Options}}</th>
            <th style="width : 200px;">{{Action}}</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>
</div>
</div>
</div>

<?php include_file('desktop', 'blink1', 'js', 'blink1');?>
<?php include_file('core', 'plugin.template', 'js');?>
