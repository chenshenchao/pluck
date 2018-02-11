# 样式
import './setup.scss'

# 脚本
import $ from 'jquery'
import 'bootstrap'

# 
$ ->
# 表单提交
    $('form.ajax[action]').submit ->
        form = $(this)

        tip = form.find '.tip'
        button = form.find 'button[type=submit]'

        button.attr 'disabled', true

        content = {}
        form.find('input[name], select[name]').each ->
            content[this.name] = $(this).val()
        form.find('textarea[name]').each ->
            content[this.name] = $(this).text()

        if content.cipher != content.confirm
            tip.text '管理员密码不一致'
            return false

        # 请求
        $.post this.action, content, ((data) ->
            console.log data
            tip.text data.tip
            if 0 == data['code']
                window.location.href = '/' + content['link'] + '/login'
            button.attr 'disabled', false
        ), 'json'
        return false