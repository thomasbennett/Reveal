tinyMCEPopup.requireLangPack();

var TimThumbDialog = {
	init : function() {
		var f = document.forms[0];
		
		selected_text = tinyMCEPopup.editor.selection.getContent({format : 'raw'});
		
		// find the first occurence of 'timthumb.php?'
		timthumb_pos = selected_text.search('timthumb.php?');
		
		if(timthumb_pos!=-1){
			// slice everything before 'timthumb.php?'
			text_timthumb = selected_text.slice(timthumb_pos);
			
			// find the first occurence of 'h='
			height_pos = text_timthumb.search('h=');
			// slice everything before 'h='
			text_height = text_timthumb.slice(height_pos);
			// find where the height value ends
			height_value_end = text_height.search('&amp;');
			// finally, the height
			the_height = text_height.substring(2,height_value_end);
			
			// find the first occurence of 'w='
			width_pos = text_timthumb.search('w=');
			// slice everything before 'w='
			text_width = text_timthumb.slice(width_pos);
			// find where the width value ends
			width_value_end = text_width.search('&amp;');
			// finally, the width
			the_width = text_width.substring(2,width_value_end);
			
			// find the first occurence of 'zc='
			zc_pos = text_timthumb.search('zc=');
			// slice everything before 'zc='
			text_zc = text_timthumb.slice(zc_pos);
			// find where the zc value ends
			zc_value_end = text_zc.search('"');
			// finally, the zc
			the_zc = text_zc.substring(3,zc_value_end);
			
			f.width.value = the_width;
			f.height.value = the_height;
			f.zc.value = the_zc;
		}
		
		// find the first occurence of 'class='
		class_pos = selected_text.search('class=');
		if(class_pos!=-1){
			// slice everything before 'class='
			text_class = selected_text.slice(class_pos+7);
			// find where the class value ends
			class_value_end = text_class.search('"');
			// finally, the class
			the_class = text_class.substring(0,class_value_end);
			
			f.classes.value = the_class;
		}
	},

	insert : function() {
		var f = document.forms[0];
		
		if(timthumb_pos!=-1){
			text_to_insert = selected_text.replace('h='+the_height,'h='+f.height.value).replace('w='+the_width,'w='+f.width.value).replace('zc='+the_zc,'zc='+f.zc.value);
			src_pos = -2; //or whatever
		}
		
		if(timthumb_pos==-1){
			plugin_url = tinyMCEPopup.getWindowArg('plugin_url');
			
			// find the first occurence of 'src="'
			src_pos = selected_text.search('src="');
			// slice everything before 'src="'
			text_src = selected_text.slice(src_pos+5);
			// find where the src value ends
			src_value_end = text_src.search('"');
			// finally, the src
			the_src = text_src.substring(0,src_value_end);
			
			// replace src
			text_to_insert = selected_text.replace(the_src, plugin_url + '/timthumb.php?src=' + the_src + '&amp;h=' + f.height.value + '&amp;w=' + f.width.value + '&amp;zc=' + f.zc.value);
		}
		
		// replace html height & width
		text_to_insert = text_to_insert.replace(/width="\d*"/g, 'width="'+f.width.value+'"').replace(/height="\d*"/g, 'height="'+f.height.value+'"');
		
		// insert new classes
		if(class_pos!=-1){
			text_to_insert = text_to_insert.replace(the_class,f.classes.value);
		}
		if(class_pos==-1 && f.classes.value!=''){
			text_to_insert = text_to_insert.replace('<img','<img class="' + f.classes.value + '" ');
		}
		
		// if there's no image inthere, just return the selected text
		if (src_pos == -1){
			text_to_insert = selected_text;
		}
		
		// Insert the contents from the input into the document
		tinyMCEPopup.editor.execCommand('mceInsertContent', false, text_to_insert);
		tinyMCEPopup.close();
	}
};

tinyMCEPopup.onInit.add(TimThumbDialog.init, TimThumbDialog);
