/*
Copyright (C) 2014  Mateusz Zawartka

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>
*/

$(document).ready(function(){
	var sponsors = $('.logo-list').children(),
	listWidth = 0,
	logoFrameWidth = $('.logo-frame').width();
	for (var i = 0; i < sponsors.length; i++) 
	{
		listWidth += $(sponsors[i]).width();
		listWidth += 20*2; // margins

	};

	if(listWidth > logoFrameWidth)
	{
		var movRange = listWidth - logoFrameWidth;
	}
	
	if(movRange)
	{
		var direction;
		function toRight()
		{
			document.addInter = setInterval(function(){
			if(parseInt($('.logo-list').css('right')) + 50 < movRange)
			{
				direction = "right";
				$('.logo-list').css('right', parseInt($('.logo-list').css("right")) + 1 +'px')
			}
			else
			{
				clearInterval(document.addInter);
				toLeft();
			}}, 15);
		}
		toRight();

		function toLeft()
		{
			document.minInter = setInterval(function(){
			if(parseInt($('.logo-list').css('right')) !== 0)
			{
				direction = "left";
				$('.logo-list').css('right', parseInt($('.logo-list').css("right")) - 1 +'px')
			}
			else
			{
				clearInterval(document.minInter);
				toRight();
			}}, 15);
		}

		$(".logo-frame").on("mouseenter", function(){
			clearInterval(document.addInter);
			clearInterval(document.minInter);
		});

		$(".logo-frame").on("mouseleave", function(){
			if(direction === "right")
				toRight()
			else
				toLeft();
		});
	}
});


/*
Copyright (C) 2014  Mateusz Zawartka

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>
*/
$(document).ready(function(){
	var valFields = $("[data-validation]"),
	names = [],
	emails = [];
	for (var i = 0; i < valFields.length; i++) {
		if($(valFields[i]).attr("data-validation") === "name")
			names.push(valFields[i])
		else if ($(valFields[i]).attr("data-validation") === "email")
			emails.push(valFields[i])
	};

	String.prototype.freeOf = function(array)
	{
		for (var i = 0; i < this.length; i++)
			for (var z = 0; z < array.length; z++)
				if(this[i].indexOf(array[z]) !== -1)
					return false;
		return true;
	}

	for (var i = 0; i < names.length; i++) {
		(function(names, i){
			$(names[i]).on("keyup", function(){
					var prohibitedCharacters = "!@#$%^&*()+=-[]\\\';,/{}|\":<>?1234567890";
					if($(names[i]).val().freeOf(prohibitedCharacters))
					{	
						$(names[i]).parent().find(".state.state-unvalid").css("display", "none");
						$(names[i]).parent().find(".state.state-valid").css("display", "block");
					}
					else
					{
						$(names[i]).parent().find(".state.state-valid").css("display", "none");
						$(names[i]).parent().find(".state.state-unvalid").css("display", "block");
					}
			});
		})(names, i);	
	};

	for (var i = 0; i < emails.length; i++) {
		(function(emails, i){
			$(emails[i]).on("keyup", function(){
					if($(emails[i]).val().indexOf("@") !== -1 
						&& $(emails[i]).val().indexOf(".") !== -1)
					{	
						$(emails[i]).parent().find(".state.state-unvalid").css("display", "none");
						$(emails[i]).parent().find(".state.state-valid").css("display", "block");
					}
					else
					{
						$(emails[i]).parent().find(".state.state-valid").css("display", "none");
						$(emails[i]).parent().find(".state.state-unvalid").css("display", "block");
					}
			});
		})(emails, i);		
	};
});
