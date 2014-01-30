var AdminList = function ()
{

	return {
		
		init : function (module, name, settings)
		{
			
			this.module		= module;
			this.name		= name;
			this.url		= '/admin/' + module + '/'; 
			this.api		= '/admin/api/' + module + '/';
			this.loadParams	= {};
			
			this.settings	= $.extend ({
				name:				"this.name",
				delete_message:		this.name + ' Deleted',
				recursive:			false,
				addchild:			false,
				edit:				true,
				remove:				true,
				root_addchild:		false,
				root_edit:			true,
				root_remove:		true
			}, settings);
			
			this.loadIndex ($('#' + this.module));
			
			$('#' + this.module).on ('click', '.open', this.openHandler);
			$('#' + this.module).on ('click', '.close', this.closeHandler);
			
		},
		
		
		/*
		 * Open item event handler
		 */
		
		openHandler : function (e)
		{
			AdminList.openItem ($(e.target));
		},
		
		
		/*
		 * Close item event handler
		 */
		
		closeHandler : function (e)
		{
			AdminList.closeItem ($(e.target));
		},
		
		
		/**
		 * Change the open item even handler
		 */
		
		changeOpenHandler : function (newHandler)
		{
			$('#' + this.module).off ('click', '.open', this.openHandler);
			this.openHandler = newHandler;
			$('#' + this.module).on ('click', '.open', this.openHandler);
		},
		
		
		/**
		 * Change the close item even handler
		 */
		
		changeCloseHandler : function (newHandler)
		{
			$('#' + this.module).off ('click', '.close', this.closeHandler);
			this.closeHandler = newHandler;
			$('#' + this.module).on ('click', '.close', this.closeHandler);
		},
		
		
		/**
		 * Load items
		 */
		
		loadIndex : function (el, generate, params)
		{
			
			var p			= this;
			var id			= el.attr ('item_id');
			generate		= typeof generate !== 'undefined' ? generate : false;
			
			if (id === undefined) {
				id = null;
			}
			
			if (typeof params !== 'undefined')
			{
				p.loadParams = params;
			}
			
			this.loading ($('#' + p.module));
			
			adminGetJSON (this.api, $.extend ({
				recursive: this.settings.recursive,
				id: id
			}, p.loadParams), function (json) {
				
				var index = (id === null)? 0 : 1;
				
				p.addItems (el, json.list, index);
				
				if (generate)
				{
					p.generateTree (el);
				}
				
			}).fail (function (json) {
				Message.addError ('Unable to load pages');
			}).always (function () {
				p.stoploading ($('#' + p.module));
			});
			
		},
		
		openItem : function (el, params)
		{
			el.removeClass ('open').addClass ('close');
			var item = el.closest ('.item[item_id]').next ('.children[item_id]');
			this.loadIndex (item, true, params);
		},
		
		closeItem : function (el)
		{
			el.removeClass ('close').addClass ('open');
			el.closest ('.item[item_id]').next ('.children[item_id]').slideUp ('fast', function () {
				$(this).empty ().show ();
			})
		},
		
		/**
		 * Delete an item
		 */
		
		deleteItem : function (item)
		{
			
			var p = this;
			
			if (confirm ('Are you sure you want to delete ' + item.children ('.title').text () + '?')) {
				adminPost (this.api + 'delete', {id: item.attr ('item_id')}, function (json)
				{

					// If the current item is the last item

					if (item.is ($('> .item:last', item.parent ())))
					{

						// Get the previous item

						var prev = item.prevAll ('.item[item_id]:first');

						// Change the previous item end tree image

						prev.find ('> .title > .tree span:last').removeClass ('sub').addClass ('end');

						// Change the previous item children tree image to blank for the item depth;

						var depth = item.parents ('.children').length +1;

						item.prev ('.children').find ('.tree span:nth-child(' + depth + ')').each (function () {
							$(this).removeClass ().addClass ('blank');
						});

					}

					// Remove children

					item.next ('.children').slideUp ('fast', function () { $(this).remove () });

					// Remove item

					item.slideUp ('fast', function () { $(this).remove () });

					Message.addMessage (p.settings.delete_message);

				}).fail (function (json) {
					Message.addError ('Unable to delete page');
				});
			}
			
		},
		
		loading : function (el)
		{
			$('<div class="loading">').hide ().insertBefore (el).fadeIn ('fast');
		},
		
		stoploading : function (el)
		{
			el.prev ('.loading').fadeOut ('slow', function () { $(this).remove () });
		},
		
		addItems : function (parent, items, count)
		{
			
			var p = this;
			
			if (typeof count === 'undefined')
			{
				var count = 0;
			}
			
			$.each (items, function () {
				
				// Make sure there is a child count
				
				if (this.child_count == undefined)
				{
					this.child_count = 0;
				}
				
				// Create item
				
				var name	= eval (p.settings.name);
				
				var item	= $('<div class="item">').attr ('item_id', this.id).attr ('child_count', this.child_count);
				var title	= $('<div class="title">').appendTo (item);
				var tree	= $('<div class="tree">').appendTo (title);
				
				if (count == 0)
				{
					
					var linkEl	= p.settings.root_edit? '<a href="' + p.url + 'edit?id=' + this.id + '">' : '<div class="name">';
					var link	= $(linkEl).text (name).appendTo (title);
					var buttons	= $('<div class="buttons">').appendTo (item);

					if (p.settings.root_addchild)
					{
						$('<a class="a" href="' + p.url + 'add?parent_id=' + this.id + '">').attr ('title', 'Add child page').appendTo (buttons);
					}

					if (p.settings.root_edit)
					{
						$('<a class="e" href="' + p.url + 'edit?id=' + this.id + '">').attr ('title', 'Edit ' + name).appendTo (buttons);
					}

					if (p.settings.root_remove)
					{
						$('<a class="d" href="#">').attr ('title', 'Delete ' + name).click (function (e) {
							p.deleteItem ($(e.target).parents ('.item[item_id]'));
						}).appendTo (buttons);
					}
					
				}
				else
				{
					
					var linkEl	= p.settings.edit? '<a href="' + p.url + 'edit?id=' + this.id + '">' : '<div class="name">';
					var link	= $(linkEl).text (name).appendTo (title);
					var buttons	= $('<div class="buttons">').appendTo (item);

					if (p.settings.addchild)
					{
						$('<a class="a" href="' + p.url + 'add?parent_id=' + this.id + '">').attr ('title', 'Add child page').appendTo (buttons);
					}

					if (p.settings.edit)
					{
						$('<a class="e" href="' + p.url + 'edit?id=' + this.id + '">').attr ('title', 'Edit ' + name).appendTo (buttons);
					}

					if (p.settings.remove)
					{
						$('<a class="d" href="#">').attr ('title', 'Delete ' + name).click (function (e) {
							p.deleteItem ($(e.target).parents ('.item[item_id]'));
						}).appendTo (buttons);
					}
					
				}
				
				item.hide ().appendTo (parent).slideDown ('fast');
				
				var children = $('<div class="children">').attr ('item_id', this.id).appendTo (parent);
				
				// Process recursively
				
				if (p.settings.recursive && this.children && this.children.length)
				{
					p.addItems (children, this.children, count+1);
				}
				
			});
			
			// Sort the last tree items on the current node
			
			$('> .item:not(:last)', parent).each (function () {
				var tree = $(this).find ('> .title > .tree');
				var span = $('<span class="sub">').appendTo (tree);
				if (!p.settings.recursive && $(this).attr ('child_count') > 0)
				{
					span.addClass ('open');
				}
			});
			
			$('> .item:last', parent).each (function () {
				var tree = $(this).find ('> .title > .tree');
				var span = $('<span class="end">').appendTo (tree);
				if (!p.settings.recursive && $(this).attr ('child_count') > 0)
				{
					span.addClass ('open');
				}
			});
			
			// Tree items on child nodes
			
			$('> .item:not(:last)', parent).each (function () {
				$(this).next ('.children').find ('.tree').each (function () {
					$('<span class="more">').prependTo (this);
				});
			});
			
			$('> .item:last', parent).each (function () {
				$(this).next ('.children').find ('.tree').each (function () {
					$('<span class="blank">').prependTo (this);
				});
			});
			
		},
		
		generateTree : function (parent)
		{
			
			var item = parent.prev ('.item');
			var cn = item.is ($('> .item:last', parent.parent ()))? 'blank' : 'more';
			$('> .item > .title > .tree', parent).each (function () {
				$('<span>').addClass (cn).prependTo (this);
			});
			
			parent.parentsUntil ('#' + this.module).each (function () {
				var item = $(this).prev ('.item');
				var cn = item.is ($('> .item:last', $(this).parent ()))? 'blank' : 'more';
				$('> .item > .title > .tree', parent).each (function () {
					$('<span>').addClass (cn).prependTo (this);
				});
			});
			
		},
		
		
		clear : function ()
		{
//			$('#' + this.module).empty ();
			$('#' + this.module).children ().fadeOut ('fast', function () {
				$(this).remove ();
			});
		}
		
		
	}
}();