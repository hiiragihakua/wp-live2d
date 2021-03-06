=== Live 2D ===

Contributors: Chiang Weifang
Donate link: https://www.5ri.org
Tags: Live2D,看板娘,萌,moe,vtuber,二次元,live,2d
Tested up to: 5.4.2
Stable tag: 1.6.2
License: MIT

== Description ==

基于Live2D 看板娘插件 (https://www.fghrsh.net/post/123.html) 的前端 HTML 源码改写

### 特性

- 基于 API 加载模型，支持 定制 提示语
- 增加：可通过WordPress后台进行参数设置，易用性++
- 增加：可后台设置看板娘样式，可直接设置宽高度等
- 支持多种一言接口，基于 JQuery UI 实现拖拽，JQuery UI引用WordPress内置，无需担心加载延迟
- 增加：可视化设置并生成waifu-tips.json，避免手动修改JSON

## 版权声明

[Flat UI Free][1]  
[live2d_src / ©journey-ad / GPL v2.0][2]  
[fghrsh.net][3]  

  [1]: https://designmodo.com/flat-free/ "Flat UI Free"
  [2]: https://github.com/journey-ad/live2d_src "基于 #fea64e4 的修改版"
  [3]: https://www.fghrsh.net/post/123.html "fghrsh.net"
  
- 请勿将本插件使用在商业网站中！
- Do not use this plugin on commercial websites！

== Installation ==

1. Upload the plugin folder to the "/wp-content/plugins/" directory of your WordPress site
2. Activate the plugin through the 'Plugins' menu in WordPress
3. See Settings -> Live 2D 设置


### 食用方法

1. 在WordPress后台添加插件压缩包安装
2. 点击启用按钮开始使用看板娘。


### 设置参数
*Tips：保存设置后仅进行了部分设置，以下是作者原文*

- 后端接口
  - `live2d_settings['modelAPI']`<br>看板娘 API 地址，默认值 `'//live2d.fghrsh.net/api/'`
  - `live2d_settings['hitokotoAPI']`<br>一言 API 接口，可选 `'lwl12.com'`，`'hitokoto.cn'`，`'jinrishici.com'` (古诗词)
- 默认模型
  - `live2d_settings['modelId']`<br>默认模型(分组) ID，可在 Demo 页 `[F12]` 呼出 `控制台(Console)` 找到
  - `live2d_settings['modelTexturesId']`<br>默认材质(模型) ID，可在 Demo 页 `[F12]` 呼出 `控制台(Console)` 找到
- 工具栏设置
  - `live2d_settings['showToolMenu']`，      显示工具栏，     `true` | `false`
  - `live2d_settings['canCloseLive2d']`，    关闭看板娘 按钮，`true` | `false`
  - `live2d_settings['canSwitchModel']`，    切换模型 按钮，  `true` | `false`
  - `live2d_settings['canSwitchTextures']`， 切换材质 按钮，  `true` | `false`
  - `live2d_settings['canSwitchHitokoto']`， 切换一言 按钮，  `true` | `false`
  - `live2d_settings['canTakeScreenshot']`， 看板娘截图 按钮，`true` | `false`
  - `live2d_settings['canTurnToHomePage']`， 返回首页 按钮，  `true` | `false`
  - `live2d_settings['canTurnToAboutPage']`，跳转关于页 按钮，`true` | `false`
- 模型切换模式
  - `live2d_settings['modelStorage']`，记录 ID (刷新后恢复)，`true` | `false`
  - `live2d_settings['modelRandMode']`，模型切换，可选 `'rand'` (随机) | `'switch'` (顺序)
  - `live2d_settings['modelTexturesRandMode']`，材质切换，可选 `'rand'` | `'switch'`
- 提示消息选项
  - `live2d_settings['showHitokoto']`，空闲时一言，`true` | `false`
  - `live2d_settings['showF12Status']`，控制台显示加载状态，`true` | `false`
  - `live2d_settings['showF12Message']`，提示消息输出到控制台，`true` | `false`
  - `live2d_settings['showF12OpenMsg']`，控制台被打开触发提醒，`true` | `false`
  - `live2d_settings['showCopyMessage']`，内容被复制触发提醒，`true` | `false`
  - `live2d_settings['showWelcomeMessage']`，进入面页时显示欢迎语，`true` | `false`
- 看板娘样式设置
  - `live2d_settings['waifuSize']`，看板娘大小，例如 `'280x250'`，`'600x535'`
  - `live2d_settings['waifuTipsSize']`，提示框大小，例如 `'250x70'`，`'570x150'`
  - `live2d_settings['waifuFontSize']`，提示框字体，例如 `'12px'`，`'30px'`
  - `live2d_settings['waifuToolFont']`，工具栏字体，例如 `'14px'`，`'36px'`
  - `live2d_settings['waifuToolLine']`，工具栏行高，例如 `'20px'`，`'36px'`
  - `live2d_settings['waifuToolTop']`，工具栏顶部边距，例如 `'0px'`，`'-60px'`
  - `live2d_settings['waifuMinWidth']`<br>面页小于 指定宽度 隐藏看板娘，例如 `'disable'` (停用)，`'768px'`
  - `live2d_settings['waifuEdgeSide']`<br>看板娘贴边方向，例如 `'left:0'` (靠左 0px)，`'right:30'` (靠右 30px)
  - `live2d_settings['waifuDraggable']`<br>拖拽样式，可选 `'disable'` (禁用)，`'axis-x'` (只能水平拖拽)，`'unlimited'` (自由拖拽)
  - `live2d_settings['waifuDraggableRevert']`，松开鼠标还原拖拽位置，`true` | `false`
- 其他杂项设置
  - `live2d_settings['l2dVersion']`，当前版本 (无需修改)
  - `live2d_settings['l2dVerDate']`，更新日期 (无需修改)
  - `live2d_settings['homePageUrl']`，首页地址，可选 `'auto'` (自动)，`'{URL 网址}'`
  - `live2d_settings['aboutPageUrl']`，关于页地址，`'{URL 网址}'`
  - `live2d_settings['screenshotCaptureName']`，看板娘截图文件名，例如 `'live2d.png'`
### 定制提示语
*Tips： `waifu-tips.json` 已自带默认提示语，如无特殊要求可跳过*
- `"waifu"` 系统提示
  - `"console_open_msg"` 控制台被打开提醒（支持多句随机）
  - `"copy_message"` 内容被复制触发提醒（支持多句随机）
  - `"screenshot_message"` 看板娘截图提示语（支持多句随机）
  - `"hidden_message"` 看板娘隐藏提示语（支持多句随机）
  - `"load_rand_textures"` 随机材质提示语（暂不支持多句）
  - `"hour_tips"` 时间段欢迎语（支持多句随机）
  - `"referrer_message"` 请求来源欢迎语（不支持多句）
  - `"referrer_hostname"` 请求来源自定义名称（根据 host，支持多句随机）
  - `"model_message"` 模型切换欢迎语（根据模型 ID，支持多句随机）
  - `"hitokoto_api_message"`，一言 API 输出模板（不支持多句随机）
- `"mouseover"` 鼠标触发提示（根据 CSS 选择器，支持多句随机）
- `"click"` 鼠标点击触发提示（根据 CSS 选择器，支持多句随机）
- `"seasons"` 节日提示（日期段，支持多句随机）

== Frequently Asked Questions ==

- 2.0版本更新预计在7月下旬，将支持moc3模型显示，以兼容4.0生成的Live2D模型

- 版本更新将在每周四进行，感谢各位的支持。

- 3.0版本将进行繁体中文版本开发。从而便于多语言支持

- 原作者https://www.fghrsh.net/post/123.html 将模型与本体分开，我认为主要原因有两个：
1. 模型文件太大了，我从https://github.com/fghrsh/live2d_api 上面下载，200多MB啊！
2. API没有加密传输，如果你本人搭建了这套API，之后被别人发现了（可以从源代码中找到）会导致大量调用


== Screenshots ==
None

== Changelog ==

= 1.6.2 =

1. 本次更新将会实装 Cubism Live2D SDK 4.0 以便测试版本
2. 由于打包JS文件变大，我会尽量在2.0上线之前进行拆分
3. 新增：模型缩放大小控制，您可以在后台自由设置模型在画布中的缩放倍数
4. 修正：默认模型 ID改为手动填写（我通过来访页面找到了各位的网站，发现我如果固定这个选项会给各位带来不便）
5. 如果有问题欢迎在Github上反馈[issues](https://github.com/jiangweifang/wp-live2d/issues)
6. 本次更新不会改变您当前的任何设置。
7. 在樱花庄的白猫主题中测试兼容性正常，请在使用之前清理之前安装的Live2D功能避免JS冲突

= 1.6.1 =

- 请注意：本次更新需要您重新设置所有数值，前端显示不正常时，请务必对数值进行默认值设置，感谢

1. 新增工具栏图标颜色和鼠标经过时的颜色控制
2. 放开看板娘提示框的尺寸控制
3. 修正设置文案准确性
4. 修正文本框与数字类型内容，强类型语言应该有的样子
5. type="range" 不是很好用，我觉得不够直观，只在一个功能上使用了
6. 减少了设置项：
- waifu-tips.js位置没有必要进行设置，有可能带来不必要的麻烦
- 主页地址设置，您已经在WordPress中设置过了，没有必要再设置一次，我将会自己读取他
7. 删除了一些没有什么用处的JS判断，精简waifu-tips.js的代码
8. 修正了一个Chrome浏览器中的警告
9. Live2D容器z轴样式提升至20，Tips的z轴提升至21，从视觉上可以看出消息提示显示在人物上方。

以下是默认值：
- 工具栏图标颜色：#5b6c7d
- 鼠标触碰时图标颜色：#34495e
- 工具栏图标大小(px)：14
- 工具栏行高(px)：12
- 工具栏顶部边距(px)：0
- 提示框大小：250x70
- 提示框字号(px)：14
- 看板娘大小：280x240
- 面页小于指定宽度(px)隐藏看板娘：760
- 看板娘贴边距离(px)：0

= 1.6.0 =

1. 增加提示框的颜色设置，可对提示框的底色，边框，阴影，进行rgba设置，可以对文字颜色进行rgb设置
2. 新增高亮显示方式，可在设置中修改高亮显示的颜色
3. 新增帮助菜单，对高级设置进行了一些说明
4. 修正了代码中冗余的一些内容
5. 更新请注意，更新完成后请重新设置提示框的颜色，否则提示框是透明的。

以下是默认值：
提示框背景色：rgba(236, 217, 188, 0.5)
边框颜色：rgba(224, 186, 140, 0.62)
阴影颜色：rgba(191, 158, 118, 0.2)
字体颜色：#32373c
高亮提醒颜色：#0099cc

= 1.5.2 =

修复保存文件的异常情况，并在无法保存文件时给出明确错误提示

= 1.5.1 =
1. 增加了设置的快捷按钮
2. 修正了设置页面保存按钮位置不对的问题

= 1.5.0 =
*支持高级设置
*去除了一个鼠标事件`.waifu #live2d`可以避免鼠标每次经过看板娘的时候他就混乱的说各种话。

= 1.3 =
*支持基础设置

= 1.0 =
*支持基础显示