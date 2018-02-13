#
#
#
import $ from 'jquery'

$ ->
    $('.sidebar').each ->
        sidebar = $(this)
        collapse = sidebar.find '.collapse'
        collapse.on 'show.bs.collapse', ->
            icon = $(this).prev('button').children 'svg'
            icon.css 'transform', 'rotateZ(-90deg)'
        collapse.on 'hide.bs.collapse', ->
            icon = $(this).prev('button').children 'svg'
            icon.css 'transform', 'rotateZ(0deg)'