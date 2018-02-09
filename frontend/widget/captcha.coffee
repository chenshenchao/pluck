#
# 验证码
#
import $ from 'jquery'

$ ->
    # 点击刷新
    $('img[alt=captcha]').click ->
        head = this.src.split('?')[0]
        tail = '?id=' + Date.parse(new Date) / 1000
        this.src = head + tail