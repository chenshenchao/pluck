#
#
#
import $ from 'jquery'
import Quill from 'quill'

$ ->
    $('.editor').each ->
        editor = $(this)
        toparea = editor.find '.toparea'
        toolbar = editor.find '.ql-toolbar'
        container = editor.find '.ql-container'
        area = new Quill container[0], {
            theme: 'snow',
            modules: {
                toolbar: {
                    container: toolbar[0]
                }
            }
        }
        resize = -> container.outerHeight(editor.height() - toparea.outerHeight())
        $(window).resize resize
        resize()