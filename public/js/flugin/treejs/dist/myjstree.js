 $(function () {
    // 6 create an instance when the DOM is ready
    $('#jstree').jstree({
      'core' : {
        "themes" : {
          "responsive" : true,
          "dots" : true, 
          "icons" : true  },
          'data' : {
            'url' : '/admin/categories/api/listall',
          },
          'check_callback' : function (operation, node, node_parent, node_position, more) {
            return true;
          },
        },
        "plugins" : ["json_data", "contextmenu", "dnd", "search", "state", "types","unique"],
        'types' : {
          'default' : {
            'icon' : 'fa fa-hand-o-right'
          },
          'f-open' : {
            'icon' : 'fa fa-folder-open fa-fw'
          },
          'f-closed' : {
            'icon' : 'fa fa-folder fa-fw'
          }
        }
      });
    $('#jstree').on('create_node.jstree', function (e, data) {
      $.ajax({
        url: '/admin/categories/create',
        type: 'POST',
        data: {parent_id: (data.node.parent=="#")?0:data.node.parent,name:data.node.text},
        success:function (res) {
          data.instance.set_id(data.node, res.id);
        }
      })
    }).on('delete_node.jstree', function (e, data) {
      $.ajax({
        url: '/admin/categories/delete/'+data.node.id,
        type: 'DELETE',
          success:function (data) {
        }
      })
    }).on('rename_node.jstree', function (e, data) {
      console.log(data.node.id);
      $.ajax({
        url: '/admin/categories/show/'+data.node.id,
        type: 'POST',
        data: {'parent_id': (data.node.parent=="#")?0:data.node.parent,'name':data.node.text},
        success:function (data) {
        }
      })
    }).bind("move_node.jstree", function(e, data) {
      console.log(data);
      $.ajax({
        url: '/admin/categories/show/'+data.node.id,
        type: 'POST',
        data: {'parent_id': (data.node.parent=="#")?0:data.node.parent,'name':data.node.text},
        success:function (data) {
        }
      })
    }).on('open_node.jstree', function (event, data) {
      data.instance.set_type(data.node,'f-open');
    }).on('close_node.jstree', function (event, data) {
      data.instance.set_type(data.node,'f-closed');
    }).on('loaded.jstree', function() {
        $('#jstree').jstree('open_all');
    }).jstree();
});