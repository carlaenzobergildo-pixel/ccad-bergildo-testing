import type { ImgHTMLAttributes } from 'react';

export default function AppLogoIcon(props: ImgHTMLAttributes<HTMLImageElement>) {
    return <img {...props} src="/imgs/Rhode%20Island%20Arknights.jpg" alt={props.alt ?? 'Rhodes Island'} />;
}
