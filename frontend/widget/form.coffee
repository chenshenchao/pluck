#
# 表单
#
import $ from 'jquery'
import {JSEncrypt} from 'jsencrypt'

$ ->
    # 表单冻结
    $('form.freeze').each ->
        form = $(this)
        # 冻结
        freeze = ->
            form.find('input, select, textarea, button[type=submit]').attr 'disabled', true
        # 解冻
        unfreeze = ->
            form.find('input, select, textarea, button[type=submit]').attr 'disabled', false
        form.find('.freezer').on 'click.bs.toggle', (e) ->
            if 'true' == this.getAttribute 'aria-pressed'
                freeze()
            else unfreeze()
        freeze()


    # 表单提交
    $('form.ajax[action][data-key]').submit ->
        form = $(this)
        action = this.action
        button = form.find 'button[type=submit]'

        # 禁用提交按钮
        button.attr 'disabled', true

        # 获取公钥
        $.get this.dataset.key, (key) ->
            encryptor = new JSEncrypt()
            encryptor.setPublicKey key

            # 生成请求参数
            content = {}
            form.find('input[name], select[name]').each ->
                value = $(this).val()
                crypt = encryptor.encrypt value
                content[this.name] = crypt
            form.find('textarea[name]').each ->
                value = $(this).text()
                crypt = encryptor.encrypt value
                content[this.name] = crypt

            # 提交表单
            $.post action, content, ((data) ->
                console.log data
                if 'target' of data
                    if ('back' == data['target'])
                        window.history.back()
                    else
                        window.location.href = data['target']
                else
                    if 'tip' of data
                        form.find('.tip').each ->
                            this.innerText = data['tip']
                    form.find('img[alt=captcha]').click()

                # 使按钮再度生效
                button.attr 'disabled', false
            ), 'json'
        return false;