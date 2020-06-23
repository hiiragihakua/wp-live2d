<?php
/**
 * Generated by the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */

require(dirname(__FILE__)  . '/waifu-Advanced.php');
require(dirname(__FILE__)  . '/waifu-Settings.php');
class live2D {
	
	

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'live_2d__add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'live_2d_waifu_page_init' ) );
		// 保存设置JSON的钩子 在执行update_option_live_2d_advanced_option_name时进行
		add_action('updated_option', function( $option_name, $old_value, $value ) {
			$this->live2D_Advanced_Save($option_name, $old_value, $value );
		}, 10, 3);
		//add_action( 'updated_option' ,array( $this, 'live2D_Advanced_Save' ) );
	}

	public function live2D_Advanced_Save($option_name, $old_value, $value ){
		if($option_name == 'live_2d_advanced_option_name'){
			$waifu_tips = new live2D_Utils();
			$waifu_Josn = $waifu_tips -> advanced_json($value);
			$waifu_tips -> update_Waifu_JsonFile($waifu_Josn);
		}
	}
	public function live_2d__add_plugin_page() {
		add_options_page(
			'Live 2D 基础设置', // page_title
			'Live 2D 设置', // menu_title
			'manage_options', // capability
			'live-2d-options', // menu_slug
			array( $this, 'live_2d__create_admin_page' ) // function
		);
	}

	public function live_2d__create_admin_page() {
		
?>

		<div class="wrap">
			<h2 class="nav-tab-wrapper">
				<a id="settings_btn" href="#settings" class="nav-tab">基础设置</a>
				<a id="advanced_btn" href="#advanced" class="nav-tab">高级设置</a>
			</h2>
			<div id="settings" class="group">
				<form method="post" action="options.php">
				<?php
					settings_fields( 'live_2d_settings_option_group' );
					do_settings_sections( 'live-2d-settings-admin' );
					submit_button('','primary','submit_settings');
				?>
				</form>
			</div>
			<div id="advanced" class="group">
				<form method="post" action="options.php">
				<?php
					settings_fields( 'live_2d_advanced_option_group' );
					do_settings_sections( 'live-2d-advanced-admin' );
					submit_button('','primary','submit_advanced');
				?>
				</form>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				// 默认值
				$('.group').hide();
				$('.nav-tab-wrapper a').removeClass('nav-tab-active');
				//表单默认值
				var activetab = '';
                if (typeof(localStorage) !== 'undefined') {
                    activetab = localStorage.getItem("activetab");
                }
                if (activetab !== '' && $(activetab).length) {
                    $(activetab).fadeIn();
                } else {
                    $('.group:first').fadeIn();
                }
				// 选项卡默认值
				if (activetab !== '' && $(activetab + '_btn').length) {
                    $(activetab + '_btn').addClass('nav-tab-active');
                }
                else {
                    $('#settings_btn').addClass('nav-tab-active');
                }
				
				// 切换按钮事件
				$('.nav-tab-wrapper a').click(function(evt){
					$('.nav-tab-wrapper a').removeClass('nav-tab-active');
					$(this).addClass('nav-tab-active');
					var clicked_group = $(this).attr('href');
					
					$('.group').hide();
                    $(clicked_group).fadeIn();
                    evt.preventDefault();
					
					if (typeof(localStorage) !== 'undefined') {
                        localStorage.setItem("activetab", clicked_group);
                    }
				});
				
				//----------------“添加/删除”按钮事件--------------

				$('input.addbtn').click(function(){
					var keyName = jQuery(this).attr('keyname');
					var arrType = jQuery(this).attr('arrtype');
					addMsgInput(keyName,this,arrType);
				});
				

				$('input.delbtn').click(function(){
					var keyName = jQuery(this).attr('keyname');
					var arrType = jQuery(this).attr('arrtype');
					delMsgInput(keyName,this,arrType);
				});

			});
			
			function addMsgInput(clsName,obj,typeName){
				var txtList = jQuery('p.'+ clsName);
				var indexNum = txtList.length
				var txtClone = txtList.last().clone();
				switch (typeName){
					case 'Selector':
						txtClone.children('input.selector').attr('name','live_2d_advanced_option_name['+clsName+']['+indexNum+'][selector]')
							.attr('id',clsName+'_'+indexNum+'_selector').val('');
						txtClone.children('input.text').attr('name','live_2d_advanced_option_name['+clsName+']['+indexNum+'][text]')
							.attr('id',clsName+'_'+indexNum+'_text').val('');
					break;
					case 'Array':
						txtClone.children('input:eq(0)').attr('name','live_2d_advanced_option_name['+clsName+']['+indexNum+'][0]')
							.attr('id',clsName+'_'+indexNum+'_0').val('');
						txtClone.children('input:eq(1)').attr('name','live_2d_advanced_option_name['+clsName+']['+indexNum+'][1]')
							.attr('id',clsName+'_'+indexNum+'_1').val('');
					break;
					case 'List':
						txtClone.children('input.textArray').attr('name','live_2d_advanced_option_name['+clsName+']['+indexNum+']')
							.attr('id',clsName+'_'+indexNum).val('');
					break;
				}
				//删除按钮
				txtClone.children('input.delbtn').attr('name',clsName+'_delbtn'+indexNum)
						.attr('id',clsName+'_delbtn'+indexNum)
						.bind('click',function(){
							delMsgInput(clsName,this,typeName);
						});
				txtList.last().after(txtClone);
			}
			
			// 删除一个动态选项isSelector是如果是有选择器的动态选项，有选择器则传true
			// isArray是没有选择器的动态选项，例如日期选择（暂时不用）
			// 如果都不传递则为，支持多句随机类型的添加器。
			function delMsgInput(clsName,obj,typeName){
				//如果没有其他组件就不能删除了
				var otherTxt = jQuery(obj).parent().siblings('.' + clsName);
				if(otherTxt.length==0) return;
				// 在删除前隐藏并重组组件
				jQuery(obj).parent().fadeOut("fast",function(){
					var allTxt = jQuery(this).siblings('.' + clsName);
					allTxt.each(function(i,e){
						switch (typeName){
							case 'Selector':
								jQuery(e).children('.selector').attr('name','live_2d_advanced_option_name['+clsName+']['+i+'][selector]')
									.attr('id',clsName+'_'+i+'_selector');
								jQuery(e).children('.text').attr('name','live_2d_advanced_option_name['+clsName+']['+i+'][text]')
									.attr('id',clsName+'_'+i+'_text');
							break;
							case 'Array':
								jQuery(e).children('input:eq(0)').attr('name','live_2d_advanced_option_name['+clsName+']['+i+'][0]')
									.attr('id',clsName+'_'+i+'_0');
								jQuery(e).children('input:eq(1)').attr('name','live_2d_advanced_option_name['+clsName+']['+i+'][1]')
									.attr('id',clsName+'_'+i+'_1');
							break;
							case 'List':
								jQuery(e).children('input.textArray').attr('name','live_2d_advanced_option_name['+clsName+']['+i+']')
									.attr('id',clsName+'_'+i);
							break;
						}
						jQuery(e).children('input.delbtn').attr('id',clsName+'_delbtn'+i)
							.attr('name',clsName+'_delbtn'+i);
					});
					// 执行删除
					this.remove();
				});
			}
		</script>
	<?php }
	
	public function live_2d_waifu_page_init(){
		$waifu_set = new live2D_Settings();
		$waifu_set->live_2d__page_init();
		
		// 加载高级设置
		$waifu_opt = new live2D_Advanced();
		$waifu_opt->live_2d_advanced_init();
	}

}
?>