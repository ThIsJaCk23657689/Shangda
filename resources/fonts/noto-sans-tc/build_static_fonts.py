"""Build Dompdf-compatible static Noto Sans TC instances from the variable font."""

import sys
from pathlib import Path

from fontTools.ttLib import TTFont
from fontTools.varLib.instancer import instantiateVariableFont


def set_names(font, style, weight, is_bold):
    names = font["name"]
    values = {
        1: "Noto Sans TC",
        2: style,
        4: "Noto Sans TC " + style,
        6: "NotoSansTC-" + style,
        16: "Noto Sans TC",
        17: style,
    }
    for name_id, value in values.items():
        names.setName(value, name_id, 3, 1, 0x409)
    font["OS/2"].usWeightClass = weight
    font["head"].macStyle = (font["head"].macStyle | 1) if is_bold else (font["head"].macStyle & ~1)


def main(source):
    output_dir = Path(__file__).resolve().parent
    for style, weight, is_bold in (("Regular", 400, False), ("Bold", 700, True)):
        font = TTFont(source)
        instantiateVariableFont(font, {"wght": weight}, inplace=True, optimize=True)
        set_names(font, style, weight, is_bold)
        font.save(output_dir / ("NotoSansTC-" + style + ".ttf"))


if __name__ == "__main__":
    if len(sys.argv) != 2:
        raise SystemExit("Usage: build_static_fonts.py path/to/NotoSansTC-VF.ttf")
    main(sys.argv[1])
