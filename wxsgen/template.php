<Wix xmlns="http://schemas.microsoft.com/wix/2006/wi">
  <Product Name="PHP" Id="<?=$product_code?>" UpgradeCode="34B67696-011A-46C7-94F8-FB450EF4CB0D"
      Language="1033" Codepage="1252" Version="<?=$version?>" Manufacturer="PHP Group">
    <Package Id="*" Keywords="Installer" Description="PHP Installer"
        Comments="Copyright © The PHP Group" Manufacturer="PHP Group"
        InstallerVersion="200" Languages="1033" Compressed="yes" SummaryCodepage="1252"/>
    <Media Id="1" Cabinet="php.cab" EmbedCab="yes"/>
    <Directory Id="TARGETDIR" Name="SourceDir">
      <Directory Id="ProgramFilesFolder" Name="PFiles">
        <Directory Id="INSTALLDIR" Name="PHP"/>
      </Directory>
    </Directory>
<?foreach ($dirs as [$id, $parent, $name]):?>
    <DirectoryRef Id="<?=$parent?>">
      <Directory Id="<?=$id?>" Name="<?=$name?>"/>
    </DirectoryRef>
<?endforeach?>
    <Feature Id="fPhp">
<?foreach ($files as $i => [$file, $subdir, $guid]):?>
      <Component Id="cmp_<?=$i?>" Directory="<?=$subdir?>" Guid="<?=$guid?>">
        <File KeyPath="yes" Source="php<?=$file?>"/>
      </Component>
<?endforeach?>
    </Feature>
    <UIRef Id="WixUI_InstallDir"/>
    <Property Id="WIXUI_INSTALLDIR" Value="INSTALLDIR"/>
    <WixVariable Id="WixUILicenseRtf" Value="<?=$license?>"/>
  </Product>
</Wix>
