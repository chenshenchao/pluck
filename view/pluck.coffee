import './pluck.scss'

import 'bootstrap'
import $ from 'jquery'

import './icon.coffee'
import './widget/form.coffee'
import './widget/sidebar.coffee'

# 默认启用
$ ->
    # 验证码点击刷新
    $('img[alt=captcha]').click ->
        head = this.src.split('?')[0]
        tail = '?timestamp=' + Date.parse(new Date) / 1000
        this.src = head + tail
