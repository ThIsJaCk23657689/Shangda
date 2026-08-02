# Noto Sans TC PDF fonts

`NotoSansTC-Regular.ttf` and `NotoSansTC-Bold.ttf` are static instances generated
from Google's Noto Sans TC variable font at weights 400 and 700. They are bundled
for Dompdf, whose variable-font rendering is not reliable across PDF readers.

Noto fonts are distributed under the SIL Open Font License 1.1:
https://openfontlicense.org/open-font-license-official-text/

To reproduce the checked-in files, install `fonttools` and run:

```text
python build_static_fonts.py path/to/NotoSansTC-VF.ttf
```
