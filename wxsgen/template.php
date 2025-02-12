<Wix xmlns="http://schemas.microsoft.com/wix/2006/wi">
  <Product Name="PHP" Id="<?=$product_code?>" UpgradeCode="34B67696-011A-46C7-94F8-FB450EF4CB0D"
      Language="1033" Codepage="1252" Version="<?=$version?>" Manufacturer="PHP Group">
    <Package Id="*" Keywords="Installer" Description="PHP Installer"
        Comments="Copyright © The PHP Group" Manufacturer="PHP Group"
        InstallerVersion="200" Languages="1033" Compressed="yes" SummaryCodepage="1252"/>
  <Media Id="1" Cabinet="php.cab" EmbedCab="yes"/>
 </Product>
</Wix>
