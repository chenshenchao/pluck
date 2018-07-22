import $ from 'jquery'
import {JSEncrypt} from 'jsencrypt'

###
Ajax 表单
###
class Ajaxform
    ###
    # 构造子
    ###
    constructor: (@element) ->
        $(@element).submit ->
            form = $(this)
            button = form.find 'button[type=submit]'
            button.attr 'disabled', true

            # 复认
            differ = @confirm()
            if 0 != differ.length
                for item in differ
                    do (item) ->
                        item.master.tooltip 'show'
                        item.slave.tooltip 'show'
                return false
            
            # 提交表单
            

            # 取消默认提交行为
            return false
    ###
    POST 提交表单
    ###
    post: (content) ->
        form = $(@element)
        action = @element.action
        $.post(action, content, ((data) ->
            if 'target' of data
                if ('back' == data['target'])
                    window.history.back()
                else
                    window.location.href = data['target']
        ), 'json').fail((handle, status, error) ->
            if 'tip' of handle.responseJSON
                form.find('.tip').each ->
                    this.innerText = handle.responseJSON['tip']
            form.find('img[alt=captcha]').click()
        ).always((handle, status) ->
            button.attr 'disabled', false
        )


    ###
    # 复认
    ###
    confirm: ->
        form = $(@element)
        group = form.find 'input[name^="confirm-"]'
        result = []
        group.each ->
            self = $(this)
            name = this.name.substring 8
            target = form.find "input[name=#{name}]"
            if this.value != target.val()
                result.append {
                    master: target
                    slave: self
                }
        return result

    ###
    # 冻结表单
    ###
    freeze: ->
        form = $(@element)
        form.find('input, select, textarea, button').attr 'disabled', true

    ###
    # 解冻
    ###
    unfreeze: ->
        form = $(@element)
        form.find('input, select, textarea, button').removeAttr 'disabled'

export default Ajaxform
