<?php
/**
 * Generated by the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */

require(dirname(__FILE__)  . '/waifu-options.php');
class LiveD {
	
	private $live_2d__options;
	
	private $waifu_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'live_2d__add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'live_2d__page_init' ) );
	}

	public function live_2d__add_plugin_page() {
		add_options_page(
			'Live 2D 基础设置', // page_title
			'Live 2D 设置', // menu_title
			'manage_options', // capability
			'live-2d-', // menu_slug
			array( $this, 'live_2d__create_admin_page' ) // function
		);
	}

	public function live_2d__create_admin_page() {
		$this->live_2d__options = get_option( 'live_2d__option_name' );
		$this->live_2d_advanced_options = get_option( 'live_2d_advanced_option_name' );

		if( isset( $_GET[ 'tab' ] ) ) {
			$active_tab = $_GET[ 'tab' ];
		} else {
			$active_tab = 'settings';
		}
		
		// 更新配置文件
		if (isset($_GET['settings-updated'])){
			$set_updated = $_GET['settings-updated'];
			if($set_updated){
				switch ($active_tab){
					case 'settings':
						//暂时不用
						//$live_2d__options = get_option( 'live_2d__option_name' ); 
						//file_put_contents(dirname(__FILE__)  . '/assets/waifu-options.json',json_encode($live_2d__options));
					break;
					case 'advanced':
						//尚未完成
						file_put_contents(plugin_dir_path(__FILE__)  . '..\\assets\\waifu-tips.json',json_encode(live_Waifu::advanced_json()));
						//echo plugin_dir_path(__FILE__)  . '..\\assets\\waifu-tips.json';
					break;
				}
			}
		}
?>
		<div class="wrap">
			<h2 class="nav-tab-wrapper">
				<a href="?page=live-2d-&tab=settings" class="nav-tab <?php echo $active_tab == 'settings' ? 'nav-tab-active' : ''; ?>">基础设置</a>
				<a href="?page=live-2d-&tab=advanced" class="nav-tab <?php echo $active_tab == 'advanced' ? 'nav-tab-active' : ''; ?>">高级设置</a>
			</h2>
			<form method="post" action="options.php">
				<?php
					if($active_tab == 'settings'){
						settings_fields( 'live_2d__option_group' );
						do_settings_sections( 'live-2d--admin' );
					}
					if($active_tab == 'advanced'){
						settings_fields( 'live_2d_advanced_option_group' );
						do_settings_sections( 'live-2d-advanced' );
					}
					submit_button();
				?>
			</form>
		</div>
	<?php }
	
	public function live_2d__page_init() {
		// 注册基础设置
		register_setting(
			'live_2d__option_group', // option_group
			'live_2d__option_name', // option_name
			array( $this, 'live_2d__sanitize' ) // sanitize_callback
		);
		
		// 加载高级设置
		$waifu_opt = new live_Waifu();
		
		$waifu_opt->live_2d_advanced_init();
		
		//$waifu_options = $live_Waifu->advanced_json() ;

		add_settings_section(
			'live_2d__setting_section', // id
			'看板娘设置（如果切换高级设置请先保存此页面的改动）', // title
			array( $this, 'live_2d__section_info' ), // callback
			'live-2d--admin' // page
		);

		add_settings_field(
			'modelAPI', // id
			'材质API ', // title
			array( $this, 'modelAPI_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'tipsMessage', // id
			'waifu-tips.json 位置', // title
			array( $this, 'tipsMessage_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'hitokotoAPI', // id
			'一言 API', // title
			array( $this, 'hitokotoAPI_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'modelId', // id
			'默认模型 ID', // title
			array( $this, 'modelId_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'modelTexturesId', // id
			'默认材质 ID', // title
			array( $this, 'modelTexturesId_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'showToolMenu', // id
			'工具栏', // title
			array( $this, 'showToolMenu_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'canCloseLive2d', // id
			'关闭看板娘按钮', // title
			array( $this, 'canCloseLive2d_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'canSwitchModel', // id
			'模型切换按钮', // title
			array( $this, 'canSwitchModel_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'canSwitchTextures', // id
			'材质切换按钮', // title
			array( $this, 'canSwitchTextures_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'canSwitchHitokoto', // id
			'一言切换按钮', // title
			array( $this, 'canSwitchHitokoto_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'canTakeScreenshot', // id
			'看板娘截图按钮', // title
			array( $this, 'canTakeScreenshot_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'canTurnToHomePage', // id
			'返回首页按钮', // title
			array( $this, 'canTurnToHomePage_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'canTurnToAboutPage', // id
			'跳转关于页按钮', // title
			array( $this, 'canTurnToAboutPage_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'modelStorage', // id
			'记录 ID', // title
			array( $this, 'modelStorage_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		
		add_settings_field(
			'modelRandMode', // id
			'模型切换方式', // title
			array( $this, 'modelRandMode_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'modelTexturesRandMode', // id
			'材质切换方式', // title
			array( $this, 'modelTexturesRandMode_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'showHitokoto', // id
			'显示一言', // title
			array( $this, 'showHitokoto_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'showF12Status', // id
			'显示加载状态', // title
			array( $this, 'showF12Status_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'showF12Message', // id
			'显示看板娘消息', // title
			array( $this, 'showF12Message_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'showF12OpenMsg', // id
			'显示控制台打开提示', // title
			array( $this, 'showF12OpenMsg_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'showCopyMessage', // id
			'显示 复制内容 提示', // title
			array( $this, 'showCopyMessage_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'showWelcomeMessage', // id
			'显示进入面页欢迎词', // title
			array( $this, 'showWelcomeMessage_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'waifuSize', // id
			'看板娘大小', // title
			array( $this, 'waifuSize_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'waifuTipsSize', // id
			'提示框大小', // title
			array( $this, 'waifuTipsSize_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'waifuFontSize', // id
			'提示框字体', // title
			array( $this, 'waifuFontSize_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'waifuToolFont', // id
			'工具栏字体', // title
			array( $this, 'waifuToolFont_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'waifuToolLine', // id
			'工具栏行高', // title
			array( $this, 'waifuToolLine_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'waifuToolTop', // id
			'工具栏顶部边距', // title
			array( $this, 'waifuToolTop_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'waifuMinWidth', // id
			'面页小于指定宽度 隐藏看板娘 输入disable禁用', // title
			array( $this, 'waifuMinWidth_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'waifuEdgeSide', // id
			'看板娘贴边方向', // title
			array( $this, 'waifuEdgeSide_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'waifuDraggable', // id
			'拖拽样式', // title
			array( $this, 'waifuDraggable_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'waifuDraggableRevert', // id
			'松开鼠标还原拖拽位置', // title
			array( $this, 'waifuDraggableRevert_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'homePageUrl', // id
			'主页地址', // title
			array( $this, 'homePageUrl_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'aboutPageUrl', // id
			'关于页地址', // title
			array( $this, 'aboutPageUrl_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);

		add_settings_field(
			'screenshotCaptureName', // id
			'看板娘截图文件名', // title
			array( $this, 'screenshotCaptureName_callback' ), // callback
			'live-2d--admin', // page
			'live_2d__setting_section' // section
		);
	}

	public function live_2d__sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['modelAPI'] ) ) {
			$sanitary_values['modelAPI'] = sanitize_text_field( $input['modelAPI'] );
		}

		if ( isset( $input['tipsMessage'] ) ) {
			$sanitary_values['tipsMessage'] = sanitize_text_field( $input['tipsMessage'] );
		}

		if ( isset( $input['hitokotoAPI'] ) ) {
			$sanitary_values['hitokotoAPI'] = $input['hitokotoAPI'];
		}

		if ( isset( $input['modelId'] ) ) {
			$sanitary_values['modelId'] = $input['modelId'];
		}

		if ( isset( $input['modelTexturesId'] ) ) {
			$sanitary_values['modelTexturesId'] = sanitize_text_field( $input['modelTexturesId'] );
		}

		if ( isset( $input['showToolMenu'] ) ) {
			$sanitary_values['showToolMenu'] = $input['showToolMenu'];
		}

		if ( isset( $input['canCloseLive2d'] ) ) {
			$sanitary_values['canCloseLive2d'] = $input['canCloseLive2d'];
		}

		if ( isset( $input['canSwitchModel'] ) ) {
			$sanitary_values['canSwitchModel'] = $input['canSwitchModel'];
		}

		if ( isset( $input['canSwitchTextures'] ) ) {
			$sanitary_values['canSwitchTextures'] = $input['canSwitchTextures'];
		}

		if ( isset( $input['canSwitchHitokoto'] ) ) {
			$sanitary_values['canSwitchHitokoto'] = $input['canSwitchHitokoto'];
		}

		if ( isset( $input['canTakeScreenshot'] ) ) {
			$sanitary_values['canTakeScreenshot'] = $input['canTakeScreenshot'];
		}

		if ( isset( $input['canTurnToHomePage'] ) ) {
			$sanitary_values['canTurnToHomePage'] = $input['canTurnToHomePage'];
		}

		if ( isset( $input['canTurnToAboutPage'] ) ) {
			$sanitary_values['canTurnToAboutPage'] = $input['canTurnToAboutPage'];
		}

		if ( isset( $input['modelStorage'] ) ) {
			$sanitary_values['modelStorage'] = $input['modelStorage'];
		}

		if ( isset( $input['modelRandMode'] ) ) {
			$sanitary_values['modelRandMode'] = $input['modelRandMode'];
		}

		if ( isset( $input['modelTexturesRandMode'] ) ) {
			$sanitary_values['modelTexturesRandMode'] = $input['modelTexturesRandMode'];
		}

		if ( isset( $input['showHitokoto'] ) ) {
			$sanitary_values['showHitokoto'] = $input['showHitokoto'];
		}

		if ( isset( $input['showF12Status'] ) ) {
			$sanitary_values['showF12Status'] = $input['showF12Status'];
		}

		if ( isset( $input['showF12Message'] ) ) {
			$sanitary_values['showF12Message'] = $input['showF12Message'];
		}

		if ( isset( $input['showF12OpenMsg'] ) ) {
			$sanitary_values['showF12OpenMsg'] = $input['showF12OpenMsg'];
		}

		if ( isset( $input['showCopyMessage'] ) ) {
			$sanitary_values['showCopyMessage'] = $input['showCopyMessage'];
		}

		if ( isset( $input['showWelcomeMessage'] ) ) {
			$sanitary_values['showWelcomeMessage'] = $input['showWelcomeMessage'];
		}

		if ( isset( $input['waifuSize'] ) ) {
			$sanitary_values['waifuSize'] = $input['waifuSize'];
		}

		if ( isset( $input['waifuTipsSize'] ) ) {
			$sanitary_values['waifuTipsSize'] = $input['waifuTipsSize'];
		}

		if ( isset( $input['waifuFontSize'] ) ) {
			$sanitary_values['waifuFontSize'] = sanitize_text_field( $input['waifuFontSize'] );
		}

		if ( isset( $input['waifuToolFont'] ) ) {
			$sanitary_values['waifuToolFont'] = sanitize_text_field( $input['waifuToolFont'] );
		}

		if ( isset( $input['waifuToolLine'] ) ) {
			$sanitary_values['waifuToolLine'] = sanitize_text_field( $input['waifuToolLine'] );
		}

		if ( isset( $input['waifuToolTop'] ) ) {
			$sanitary_values['waifuToolTop'] = sanitize_text_field( $input['waifuToolTop'] );
		}

		if ( isset( $input['waifuMinWidth'] ) ) {
			$sanitary_values['waifuMinWidth'] = sanitize_text_field( $input['waifuMinWidth'] );
		}

		if ( isset( $input['waifuEdgeSide'] ) ) {
			$sanitary_values['waifuEdgeSide'] = sanitize_text_field( $input['waifuEdgeSide'] );
		}

		if ( isset( $input['waifuDraggable'] ) ) {
			$sanitary_values['waifuDraggable'] = $input['waifuDraggable'];
		}

		if ( isset( $input['waifuDraggableRevert'] ) ) {
			$sanitary_values['waifuDraggableRevert'] = $input['waifuDraggableRevert'];
		}

		if ( isset( $input['homePageUrl'] ) ) {
			$sanitary_values['homePageUrl'] = sanitize_text_field( $input['homePageUrl'] );
		}

		if ( isset( $input['aboutPageUrl'] ) ) {
			$sanitary_values['aboutPageUrl'] = sanitize_text_field( $input['aboutPageUrl'] );
		}

		if ( isset( $input['screenshotCaptureName'] ) ) {
			$sanitary_values['screenshotCaptureName'] = sanitize_text_field( $input['screenshotCaptureName'] );
		}
echo '123123123';
		return $sanitary_values;
	}

	public function live_2d__section_info() {
	}

	public function modelAPI_callback() {
		printf(
			'<input class="regular-text" type="text" name="live_2d__option_name[modelAPI]" id="modelAPI" value="%s">',
			isset( $this->live_2d__options['modelAPI'] ) ? esc_attr( $this->live_2d__options['modelAPI']) : '//live2d.fghrsh.net/api/'
		);
	}

	public function tipsMessage_callback() {
		printf(
			'<input class="regular-text" type="text" name="live_2d__option_name[tipsMessage]" id="tipsMessage" value="%s">',
			isset( $this->live_2d__options['tipsMessage'] ) ? esc_attr( $this->live_2d__options['tipsMessage']) : 'waifu-tips.json'
		);
	}

	public function hitokotoAPI_callback() {
		?> <select name="live_2d__option_name[hitokotoAPI]" id="hitokotoAPI">
			<?php $selected = (isset( $this->live_2d__options['hitokotoAPI'] ) && $this->live_2d__options['hitokotoAPI'] === 'lwl12.com') ? 'selected' : 'selected' ; ?>
			<option <?php echo $selected; ?>>lwl12.com</option>
			<?php $selected = (isset( $this->live_2d__options['hitokotoAPI'] ) && $this->live_2d__options['hitokotoAPI'] === 'hitokoto.cn') ? 'selected' : '' ; ?>
			<option <?php echo $selected; ?>>hitokoto.cn</option>
			<?php $selected = (isset( $this->live_2d__options['hitokotoAPI'] ) && $this->live_2d__options['hitokotoAPI'] === 'jinrishici.com') ? 'selected' : '' ; ?>
			<option <?php echo $selected; ?>>jinrishici.com</option>
		</select> <?php
	}

	public function modelId_callback() {
		?> <select name="live_2d__option_name[modelId]" id="modelId">
			<?php $selected = (isset( $this->live_2d__options['modelId'] ) && $this->live_2d__options['modelId'] === '1') ? 'selected' : 'selected' ; ?>
			<option value="1" <?php echo $selected; ?>>来自药水制作师的 Pio</option>
			<?php $selected = (isset( $this->live_2d__options['modelId'] ) && $this->live_2d__options['modelId'] === '2') ? 'selected' : '' ; ?>
			<option value="2" <?php echo $selected; ?>>来自药水制作师的 Tia</option>
			<?php $selected = (isset( $this->live_2d__options['modelId'] ) && $this->live_2d__options['modelId'] === '3') ? 'selected' : '' ; ?>
			<option value="3" <?php echo $selected; ?>>来自 Bilibili Live 的 22</option>
			<?php $selected = (isset( $this->live_2d__options['modelId'] ) && $this->live_2d__options['modelId'] === '4') ? 'selected' : '' ; ?>
			<option value="4" <?php echo $selected; ?>>来自 Bilibili Live 的 33</option>
			<?php $selected = (isset( $this->live_2d__options['modelId'] ) && $this->live_2d__options['modelId'] === '5') ? 'selected' : '' ; ?>
			<option value="5" <?php echo $selected; ?>>Shizuku Talk ！这里是 Shizuku</option>
			<?php $selected = (isset( $this->live_2d__options['modelId'] ) && $this->live_2d__options['modelId'] === '6') ? 'selected' : '' ; ?>
			<option value="6" <?php echo $selected; ?>>超次元游戏：海王星</option>
			<?php $selected = (isset( $this->live_2d__options['modelId'] ) && $this->live_2d__options['modelId'] === '7') ? 'selected' : '' ; ?>
			<option value="7" <?php echo $selected; ?>>艦隊これくしょん / 叢雲(むらくも)</option>
		</select> <?php
	}

	public function modelTexturesId_callback() {
		printf(
			'<input class="regular-text" type="text" name="live_2d__option_name[modelTexturesId]" id="modelTexturesId" value="%s">',
			isset( $this->live_2d__options['modelTexturesId'] ) ? esc_attr( $this->live_2d__options['modelTexturesId']) : '53'
		);
	}

	public function showToolMenu_callback() {
		?> <fieldset><?php $checked = ( isset( $this->live_2d__options['showToolMenu'] ) && $this->live_2d__options['showToolMenu'] === 'true' ) ? 'checked' : '' ; ?>
		<label for="showToolMenu-0"><input type="radio" name="live_2d__option_name[showToolMenu]" id="showToolMenu-0" value="true" <?php echo $checked; ?>> 显示</label><br>
		<?php $checked = ( isset( $this->live_2d__options['showToolMenu'] ) && $this->live_2d__options['showToolMenu'] === 'false' ) ? 'checked' : '' ; ?>
		<label for="showToolMenu-1"><input type="radio" name="live_2d__option_name[showToolMenu]" id="showToolMenu-1" value="false" <?php echo $checked; ?>> 隐藏</label></fieldset> <?php
	}

	public function canCloseLive2d_callback() {
		?> <fieldset><?php $checked = ( isset( $this->live_2d__options['canCloseLive2d'] ) && $this->live_2d__options['canCloseLive2d'] === 'true' ) ? 'checked' : '' ; ?>
		<label for="canCloseLive2d-0"><input type="radio" name="live_2d__option_name[canCloseLive2d]" id="canCloseLive2d-0" value="true" <?php echo $checked; ?>> 开启</label><br>
		<?php $checked = ( isset( $this->live_2d__options['canCloseLive2d'] ) && $this->live_2d__options['canCloseLive2d'] === 'false' ) ? 'checked' : '' ; ?>
		<label for="canCloseLive2d-1"><input type="radio" name="live_2d__option_name[canCloseLive2d]" id="canCloseLive2d-1" value="false" <?php echo $checked; ?>> 关闭</label></fieldset> <?php
	}

	public function canSwitchModel_callback() {
		?> <fieldset><?php $checked = ( isset( $this->live_2d__options['canSwitchModel'] ) && $this->live_2d__options['canSwitchModel'] === 'true' ) ? 'checked' : '' ; ?>
		<label for="canSwitchModel-0"><input type="radio" name="live_2d__option_name[canSwitchModel]" id="canSwitchModel-0" value="true" <?php echo $checked; ?>> 显示</label><br>
		<?php $checked = ( isset( $this->live_2d__options['canSwitchModel'] ) && $this->live_2d__options['canSwitchModel'] === 'false' ) ? 'checked' : '' ; ?>
		<label for="canSwitchModel-1"><input type="radio" name="live_2d__option_name[canSwitchModel]" id="canSwitchModel-1" value="false" <?php echo $checked; ?>> 隐藏</label></fieldset> <?php
	}

	public function canSwitchTextures_callback() {
		?> <fieldset><?php $checked = ( isset( $this->live_2d__options['canSwitchTextures'] ) && $this->live_2d__options['canSwitchTextures'] === 'true' ) ? 'checked' : '' ; ?>
		<label for="canSwitchTextures-0"><input type="radio" name="live_2d__option_name[canSwitchTextures]" id="canSwitchTextures-0" value="true" <?php echo $checked; ?>> 显示</label><br>
		<?php $checked = ( isset( $this->live_2d__options['canSwitchTextures'] ) && $this->live_2d__options['canSwitchTextures'] === 'false' ) ? 'checked' : '' ; ?>
		<label for="canSwitchTextures-1"><input type="radio" name="live_2d__option_name[canSwitchTextures]" id="canSwitchTextures-1" value="false" <?php echo $checked; ?>> 隐藏</label></fieldset> <?php
	}

	public function canSwitchHitokoto_callback() {
		?> <fieldset><?php $checked = ( isset( $this->live_2d__options['canSwitchHitokoto'] ) && $this->live_2d__options['canSwitchHitokoto'] === 'true' ) ? 'checked' : '' ; ?>
		<label for="canSwitchHitokoto-0"><input type="radio" name="live_2d__option_name[canSwitchHitokoto]" id="canSwitchHitokoto-0" value="true" <?php echo $checked; ?>> 显示</label><br>
		<?php $checked = ( isset( $this->live_2d__options['canSwitchHitokoto'] ) && $this->live_2d__options['canSwitchHitokoto'] === 'false' ) ? 'checked' : '' ; ?>
		<label for="canSwitchHitokoto-1"><input type="radio" name="live_2d__option_name[canSwitchHitokoto]" id="canSwitchHitokoto-1" value="false" <?php echo $checked; ?>> 隐藏</label></fieldset> <?php
	}

	public function canTakeScreenshot_callback() {
		?> <fieldset><?php $checked = ( isset( $this->live_2d__options['canTakeScreenshot'] ) && $this->live_2d__options['canTakeScreenshot'] === 'true' ) ? 'checked' : '' ; ?>
		<label for="canTakeScreenshot-0"><input type="radio" name="live_2d__option_name[canTakeScreenshot]" id="canTakeScreenshot-0" value="true" <?php echo $checked; ?>> 显示</label><br>
		<?php $checked = ( isset( $this->live_2d__options['canTakeScreenshot'] ) && $this->live_2d__options['canTakeScreenshot'] === 'false' ) ? 'checked' : '' ; ?>
		<label for="canTakeScreenshot-1"><input type="radio" name="live_2d__option_name[canTakeScreenshot]" id="canTakeScreenshot-1" value="false" <?php echo $checked; ?>> 隐藏</label></fieldset> <?php
	}

	public function canTurnToHomePage_callback() {
		?> <fieldset><?php $checked = ( isset( $this->live_2d__options['canTurnToHomePage'] ) && $this->live_2d__options['canTurnToHomePage'] === 'true' ) ? 'checked' : '' ; ?>
		<label for="canTurnToHomePage-0"><input type="radio" name="live_2d__option_name[canTurnToHomePage]" id="canTurnToHomePage-0" value="true" <?php echo $checked; ?>> 显示</label><br>
		<?php $checked = ( isset( $this->live_2d__options['canTurnToHomePage'] ) && $this->live_2d__options['canTurnToHomePage'] === 'false' ) ? 'checked' : '' ; ?>
		<label for="canTurnToHomePage-1"><input type="radio" name="live_2d__option_name[canTurnToHomePage]" id="canTurnToHomePage-1" value="false" <?php echo $checked; ?>> 隐藏</label></fieldset> <?php
	}

	public function canTurnToAboutPage_callback() {
		?> <fieldset><?php $checked = ( isset( $this->live_2d__options['canTurnToAboutPage'] ) && $this->live_2d__options['canTurnToAboutPage'] === 'true' ) ? 'checked' : '' ; ?>
		<label for="canTurnToAboutPage-0"><input type="radio" name="live_2d__option_name[canTurnToAboutPage]" id="canTurnToAboutPage-0" value="true" <?php echo $checked; ?>> 显示</label><br>
		<?php $checked = ( isset( $this->live_2d__options['canTurnToAboutPage'] ) && $this->live_2d__options['canTurnToAboutPage'] === 'false' ) ? 'checked' : '' ; ?>
		<label for="canTurnToAboutPage-1"><input type="radio" name="live_2d__option_name[canTurnToAboutPage]" id="canTurnToAboutPage-1" value="false" <?php echo $checked; ?>> 隐藏</label></fieldset> <?php
	}

	public function modelStorage_callback() {
		?> <fieldset><?php $checked = ( isset( $this->live_2d__options['modelStorage'] ) && $this->live_2d__options['modelStorage'] === 'true' ) ? 'checked' : '' ; ?>
		<label for="modelStorage-0"><input type="radio" name="live_2d__option_name[modelStorage]" id="modelStorage-0" value="true" <?php echo $checked; ?>> 显示</label><br>
		<?php $checked = ( isset( $this->live_2d__options['modelStorage'] ) && $this->live_2d__options['modelStorage'] === 'false' ) ? 'checked' : '' ; ?>
		<label for="modelStorage-1"><input type="radio" name="live_2d__option_name[modelStorage]" id="modelStorage-1" value="false" <?php echo $checked; ?>> 隐藏</label></fieldset> <?php
	}

	public function modelRandMode_callback() {
		?> <select name="live_2d__option_name[modelRandMode]" id="modelRandMode">
			<?php $selected = (isset( $this->live_2d__options['modelRandMode'] ) && $this->live_2d__options['modelRandMode'] === 'rand') ? 'selected' : '' ; ?>
			<option value="rand" <?php echo $selected; ?>>随机</option>
			<?php $selected = (isset( $this->live_2d__options['modelRandMode'] ) && $this->live_2d__options['modelRandMode'] === 'switch') ? 'selected' : '' ; ?>
			<option value="switch" <?php echo $selected; ?>>顺序</option>
		</select> <?php
	}

	public function modelTexturesRandMode_callback() {
		?> <select name="live_2d__option_name[modelTexturesRandMode]" id="modelTexturesRandMode">
			<?php $selected = (isset( $this->live_2d__options['modelTexturesRandMode'] ) && $this->live_2d__options['modelTexturesRandMode'] === 'rand') ? 'selected' : '' ; ?>
			<option value="rand" <?php echo $selected; ?>>随机</option>
			<?php $selected = (isset( $this->live_2d__options['modelTexturesRandMode'] ) && $this->live_2d__options['modelTexturesRandMode'] === 'switch') ? 'selected' : '' ; ?>
			<option value="switch" <?php echo $selected; ?>>顺序</option>
		</select> <?php
	}

	public function showHitokoto_callback() {
		?> <fieldset><?php $checked = ( isset( $this->live_2d__options['showHitokoto'] ) && $this->live_2d__options['showHitokoto'] === 'true' ) ? 'checked' : '' ; ?>
		<label for="showHitokoto-0"><input type="radio" name="live_2d__option_name[showHitokoto]" id="showHitokoto-0" value="true" <?php echo $checked; ?>> 显示</label><br>
		<?php $checked = ( isset( $this->live_2d__options['showHitokoto'] ) && $this->live_2d__options['showHitokoto'] === 'false' ) ? 'checked' : '' ; ?>
		<label for="showHitokoto-1"><input type="radio" name="live_2d__option_name[showHitokoto]" id="showHitokoto-1" value="false" <?php echo $checked; ?>> 隐藏</label></fieldset> <?php
	}

	public function showF12Status_callback() {
		?> <fieldset><?php $checked = ( isset( $this->live_2d__options['showF12Status'] ) && $this->live_2d__options['showF12Status'] === 'true' ) ? 'checked' : '' ; ?>
		<label for="showF12Status-0"><input type="radio" name="live_2d__option_name[showF12Status]" id="showF12Status-0" value="true" <?php echo $checked; ?>> 显示</label><br>
		<?php $checked = ( isset( $this->live_2d__options['showF12Status'] ) && $this->live_2d__options['showF12Status'] === 'false' ) ? 'checked' : '' ; ?>
		<label for="showF12Status-1"><input type="radio" name="live_2d__option_name[showF12Status]" id="showF12Status-1" value="false" <?php echo $checked; ?>> 隐藏</label></fieldset> <?php
	}

	public function showF12Message_callback() {
		?> <fieldset><?php $checked = ( isset( $this->live_2d__options['showF12Message'] ) && $this->live_2d__options['showF12Message'] === 'true' ) ? 'checked' : '' ; ?>
		<label for="showF12Message-0"><input type="radio" name="live_2d__option_name[showF12Message]" id="showF12Message-0" value="true" <?php echo $checked; ?>> 显示</label><br>
		<?php $checked = ( isset( $this->live_2d__options['showF12Message'] ) && $this->live_2d__options['showF12Message'] === 'false' ) ? 'checked' : '' ; ?>
		<label for="showF12Message-1"><input type="radio" name="live_2d__option_name[showF12Message]" id="showF12Message-1" value="false" <?php echo $checked; ?>> 隐藏</label></fieldset> <?php
	}

	public function showF12OpenMsg_callback() {
		?> <fieldset><?php $checked = ( isset( $this->live_2d__options['showF12OpenMsg'] ) && $this->live_2d__options['showF12OpenMsg'] === 'true' ) ? 'checked' : '' ; ?>
		<label for="showF12OpenMsg-0"><input type="radio" name="live_2d__option_name[showF12OpenMsg]" id="showF12OpenMsg-0" value="true" <?php echo $checked; ?>> 显示</label><br>
		<?php $checked = ( isset( $this->live_2d__options['showF12OpenMsg'] ) && $this->live_2d__options['showF12OpenMsg'] === 'false' ) ? 'checked' : '' ; ?>
		<label for="showF12OpenMsg-1"><input type="radio" name="live_2d__option_name[showF12OpenMsg]" id="showF12OpenMsg-1" value="false" <?php echo $checked; ?>> 隐藏</label></fieldset> <?php
	}

	public function showCopyMessage_callback() {
		?> <fieldset><?php $checked = ( isset( $this->live_2d__options['showCopyMessage'] ) && $this->live_2d__options['showCopyMessage'] === 'true' ) ? 'checked' : '' ; ?>
		<label for="showCopyMessage-0"><input type="radio" name="live_2d__option_name[showCopyMessage]" id="showCopyMessage-0" value="true" <?php echo $checked; ?>> 显示</label><br>
		<?php $checked = ( isset( $this->live_2d__options['showCopyMessage'] ) && $this->live_2d__options['showCopyMessage'] === 'false' ) ? 'checked' : '' ; ?>
		<label for="showCopyMessage-1"><input type="radio" name="live_2d__option_name[showCopyMessage]" id="showCopyMessage-1" value="false" <?php echo $checked; ?>> 隐藏</label></fieldset> <?php
	}

	public function showWelcomeMessage_callback() {
		?> <fieldset><?php $checked = ( isset( $this->live_2d__options['showWelcomeMessage'] ) && $this->live_2d__options['showWelcomeMessage'] === 'true' ) ? 'checked' : '' ; ?>
		<label for="showWelcomeMessage-0"><input type="radio" name="live_2d__option_name[showWelcomeMessage]" id="showWelcomeMessage-0" value="true" <?php echo $checked; ?>> 显示</label><br>
		<?php $checked = ( isset( $this->live_2d__options['showWelcomeMessage'] ) && $this->live_2d__options['showWelcomeMessage'] === 'false' ) ? 'checked' : '' ; ?>
		<label for="showWelcomeMessage-1"><input type="radio" name="live_2d__option_name[showWelcomeMessage]" id="showWelcomeMessage-1" value="false" <?php echo $checked; ?>> 隐藏</label></fieldset> <?php
	}

	public function waifuSize_callback() {
		?> <select name="live_2d__option_name[waifuSize]" id="waifuSize">
			<?php $selected = (isset( $this->live_2d__options['waifuSize'] ) && $this->live_2d__options['waifuSize'] === '280x250') ? 'selected' : '' ; ?>
			<option <?php echo $selected; ?>>280x250</option>
			<?php $selected = (isset( $this->live_2d__options['waifuSize'] ) && $this->live_2d__options['waifuSize'] === '600x535') ? 'selected' : '' ; ?>
			<option <?php echo $selected; ?>>600x535</option>
		</select> <?php
	}

	public function waifuTipsSize_callback() {
		?> <select name="live_2d__option_name[waifuTipsSize]" id="waifuTipsSize">
			<?php $selected = (isset( $this->live_2d__options['waifuTipsSize'] ) && $this->live_2d__options['waifuTipsSize'] === '250x70') ? 'selected' : '' ; ?>
			<option <?php echo $selected; ?>>250x70</option>
			<?php $selected = (isset( $this->live_2d__options['waifuTipsSize'] ) && $this->live_2d__options['waifuTipsSize'] === '570x150') ? 'selected' : '' ; ?>
			<option <?php echo $selected; ?>>570x150</option>
		</select> <?php
	}

	public function waifuFontSize_callback() {
		printf(
			'<input class="regular-text" type="text" name="live_2d__option_name[waifuFontSize]" id="waifuFontSize" value="%s">',
			isset( $this->live_2d__options['waifuFontSize'] ) ? esc_attr( $this->live_2d__options['waifuFontSize']) : '12px'
		);
	}

	public function waifuToolFont_callback() {
		printf(
			'<input class="regular-text" type="text" name="live_2d__option_name[waifuToolFont]" id="waifuToolFont" value="%s">',
			isset( $this->live_2d__options['waifuToolFont'] ) ? esc_attr( $this->live_2d__options['waifuToolFont']) : '14px'
		);
	}

	public function waifuToolLine_callback() {
		printf(
			'<input class="regular-text" type="text" name="live_2d__option_name[waifuToolLine]" id="waifuToolLine" value="%s">',
			isset( $this->live_2d__options['waifuToolLine'] ) ? esc_attr( $this->live_2d__options['waifuToolLine']) : '20px'
		);
	}

	public function waifuToolTop_callback() {
		printf(
			'<input class="regular-text" type="text" name="live_2d__option_name[waifuToolTop]" id="waifuToolTop" value="%s">',
			isset( $this->live_2d__options['waifuToolTop'] ) ? esc_attr( $this->live_2d__options['waifuToolTop']) : '0px'
		);
	}

	public function waifuMinWidth_callback() {
		printf(
			'<input class="regular-text" type="text" name="live_2d__option_name[waifuMinWidth]" id="waifuMinWidth" value="%s">',
			isset( $this->live_2d__options['waifuMinWidth'] ) ? esc_attr( $this->live_2d__options['waifuMinWidth']) : '768px'
		);
	}

	public function waifuEdgeSide_callback() {
		printf(
			'<input class="regular-text" type="text" name="live_2d__option_name[waifuEdgeSide]" id="waifuEdgeSide" value="%s">',
			isset( $this->live_2d__options['waifuEdgeSide'] ) ? esc_attr( $this->live_2d__options['waifuEdgeSide']) : 'left:0'
		);
	}

	public function waifuDraggable_callback() {
		?> <select name="live_2d__option_name[waifuDraggable]" id="waifuDraggable">
			<?php $selected = (isset( $this->live_2d__options['waifuDraggable'] ) && $this->live_2d__options['waifuDraggable'] === 'disable') ? 'selected' : '' ; ?>
			<option value="disable" <?php echo $selected; ?>>禁用</option>
			<?php $selected = (isset( $this->live_2d__options['waifuDraggable'] ) && $this->live_2d__options['waifuDraggable'] === 'axis-x') ? 'selected' : '' ; ?>
			<option value="axis-x" <?php echo $selected; ?>>只能水平拖拽</option>
			<?php $selected = (isset( $this->live_2d__options['waifuDraggable'] ) && $this->live_2d__options['waifuDraggable'] === 'unlimited') ? 'selected' : '' ; ?>
			<option value="unlimited" <?php echo $selected; ?>>自由拖拽</option>
		</select> <?php
	}

	public function waifuDraggableRevert_callback() {
		?> <fieldset><?php $checked = ( isset( $this->live_2d__options['waifuDraggableRevert'] ) && $this->live_2d__options['waifuDraggableRevert'] === 'true' ) ? 'checked' : '' ; ?>
		<label for="waifuDraggableRevert-0"><input type="radio" name="live_2d__option_name[waifuDraggableRevert]" id="waifuDraggableRevert-0" value="true" <?php echo $checked; ?>> 还原</label><br>
		<?php $checked = ( isset( $this->live_2d__options['waifuDraggableRevert'] ) && $this->live_2d__options['waifuDraggableRevert'] === 'false' ) ? 'checked' : '' ; ?>
		<label for="waifuDraggableRevert-1"><input type="radio" name="live_2d__option_name[waifuDraggableRevert]" id="waifuDraggableRevert-1" value="false" <?php echo $checked; ?>> 不还原</label></fieldset> <?php
	}

	public function homePageUrl_callback() {
		printf(
			'<input class="regular-text" type="text" name="live_2d__option_name[homePageUrl]" id="homePageUrl" value="%s">',
			isset( $this->live_2d__options['homePageUrl'] ) ? esc_attr( $this->live_2d__options['homePageUrl']) : 'auto'
		);
	}

	public function aboutPageUrl_callback() {
		printf(
			'<input class="regular-text" type="text" name="live_2d__option_name[aboutPageUrl]" id="aboutPageUrl" value="%s">',
			isset( $this->live_2d__options['aboutPageUrl'] ) ? esc_attr( $this->live_2d__options['aboutPageUrl']) : '#'
		);
	}

	public function screenshotCaptureName_callback() {
		printf(
			'<input class="regular-text" type="text" name="live_2d__option_name[screenshotCaptureName]" id="screenshotCaptureName" value="%s">',
			isset( $this->live_2d__options['screenshotCaptureName'] ) ? esc_attr( $this->live_2d__options['screenshotCaptureName']) : 'live2d.png'
		);
	}

}
?>
