//

if (/-skin|reset|fonts|grids|base/.test(me.name)){
    me.type = 'css';
    me.path = me.path.replace(/\.js/, '.css');
    me.path = me.path.replace(/\/yui2-skin/, '/assets/skins/sam/yui2-skin');
}
